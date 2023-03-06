<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\format\AbstractFormatter;
use bhenk\doc2rst\format\CodeBlockFormatter;
use bhenk\doc2rst\format\RestructuredTextFormatter;
use bhenk\doc2rst\tag\TagFactory;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionMethod;
use function count;
use function explode;
use function implode;
use function is_null;
use function preg_match_all;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strpos;
use function substr;
use function trim;

/**
 * Reads
 * and
 * processes
 * DocComments.
 * According to {@link https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md#3-definitions PSR-5 Definitions}
 * a "DocComment" is a special type of comment which MUST
 *
 * * start with the character sequence :tech:`/**` followed by a whitespace character
 * * end with :tech:`*\ /` and
 * * have zero or more lines in between.
 *
 * This CommentLexer reads *summary* lines up to the first period or the first white line is encountered.
 * The rest of the PHPdoc comment is treated as *description*.
 *
 * Inline tags are treated as such and rendered at their
 *original location in the text. Inline tags begin with :tech:`{\ @` and end with a :tech:`}`. Non-inline tags
 * that are not at the start of a line, will not be rendered. (For instance @link http://whatever.com whatever.)
 *
 * Tags at the start of a line are filtered out, rendered and appear in a predefined order and location
 * in the documentation. @todo link to comment and tag order
 *
 */
class CommentLexer extends AbstractLexer {

    private CommentOrganizer $organizer;
    private ?AbstractFormatter $formatter = null;

    private string $summary_line = "";

    function __construct(private readonly ReflectionMethod|ReflectionClass|ReflectionClassConstant $doc_owner) {
        $this->organizer = new CommentOrganizer();
        $this->lex();
    }

    /**
     * @return CommentOrganizer
     */
    public function getCommentOrganizer(): CommentOrganizer {
        return $this->organizer;
    }

    public function lex(): void {
        $doc = $this->doc_owner->getDocComment();
        if ($doc and str_starts_with($doc, "/**")) {
            $this->processDoc($doc);
        }
        $this->addSegment($this->organizer);
    }

    private function processDoc(string $doc) {
        $rows = explode(PHP_EOL, $doc);
        $summary_on = true;
        $code_on = false;
        for ($i = 1; $i < count($rows) - 1; $i++) {
            $line = substr(trim($rows[$i]), 1);
            if (str_starts_with($line, " ")) $line = substr($line, 1);

            if (str_starts_with($line, "```") and !$code_on) $code_on = true;
            if ($summary_on) {
                $summary_on = $this->handleSummary($line);
            } elseif ($code_on) {
                $code_on = $this->handleCode($line);
            } else if (str_starts_with($line, "@")) {
                $this->organizer->addTag(TagFactory::getTagClass($line));
            } else {
                $parts = TagFactory::explodeOnTags($line);
                $processed = TagFactory::resolveInlineTags($parts);
                $this->organizer->addLine(implode("", $processed));
            }
        }
    }

    private function handleSummary(string $line): bool {
        $dot = strpos($line, ".");
        $white_line = empty(trim($line));
        if ($dot) {
            $line = substr($line, 0, $dot);
        }
        $line = trim($line);
        if (!empty($line)) $line .= " ";
        $this->summary_line .= $line;
        if ($dot or $white_line) {
            $parts = TagFactory::explodeOnTags($this->summary_line);
            $parts = self::makeStrongParts($parts);
            $processed = TagFactory::resolveInlineTags($parts);
            $line = self::preserveMarkup(implode(" ", $processed));
            //$line = str_replace("****", "", $line);
            $this->organizer->setSummary($line);
            return false;
        }
        return true;
    }

    private function handleCode(string $line): bool {
        if (!is_null($this->formatter)) {
            $result = $this->formatter->handleLine($line);
            if (!$result) $this->formatter = null;
            return $result;
        }
        $formatter_name = substr($line, 3);
        if (empty($formatter_name)) {
            $this->formatter = new CodeBlockFormatter($this->organizer);
            return $this->formatter->handleLine($line);
        }
        if (str_starts_with($formatter_name, "rst")) {
            $this->formatter = new RestructuredTextFormatter($this->organizer);
            return $this->formatter->handleLine($line);
        }
        return false;
    }

    /**
     * Markup parts with strong inline markup.
     *
     * Inline tags will **not** be treated. Example:
     *
     * ```rst replace & @
     * .. code-block::
     *
     *    before: ["Gets the", "{&link BarClass}", "out of the Foo"]
     *
     *    after:  ["**Gets the**", "{&link BarClass}", "**out of the Foo**"]
     * ```
     *
     * @param array $parts pieces of text
     * @return array pieces of text with **strong** inline markup
     */
    public static function makeStrongParts(array $parts): array {
        for ($i = 0; $i < count($parts); $i++) {
            if (!str_starts_with($parts[$i], "{@")) {
                $parts[$i] = "**" . trim($parts[$i]) . "**";
            }
        }
        return $parts;
    }

    /**
     * Preserve markup in an otherwise *strong* line.
     *
     * Example:
     *
     * ```rst
     * .. code-block::
     *
     *     before: "**Preserves italic *null* and ticks ``true`` markup**"
     *
     *     after:  "**Preserves italic** *null* **and ticks** ``true`` **markup**"
     * ```
     *
     * @param string $line string with **bold** markup at begin and end
     * @return string string with other markup preserved
     */
    public static function preserveMarkup(string $line): string {
        // emphasis (italic)
        if (str_ends_with($line, "***")) $line = substr($line, 0, -2) . " ";
        if (str_starts_with($line, "***")) $line = " " . substr($line, 2);
        $pattern = '{\s\*\w+\*\s}';
        if (preg_match_all($pattern, $line, $matches)) {
            foreach ($matches[0] as $match) {
                $line = str_replace($match, "**" . $match . "**", $line);
            }
            if (str_ends_with($line, " **")) $line = substr($line, 0, -3);
            if (str_starts_with($line, "** *")) $line = substr($line, 3);
        }

        if (str_ends_with($line, "``**")) $line = substr($line, 0, -2) . " ";
        if (str_starts_with($line, "**``")) $line = " " . substr($line, 2);
        $pattern = '{\s``\w+``\s}';
        if (preg_match_all($pattern, $line, $matches)) {
            foreach ($matches[0] as $match) {
                $line = str_replace($match, "**" . $match . "**", $line);
            }
            if (str_ends_with($line, " **")) $line = substr($line, 0, -3);
            if (str_starts_with($line, "** ``")) $line = substr($line, 3);
        }
        return trim($line);
    }

}