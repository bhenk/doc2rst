<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\format\AbstractFormatter;
use bhenk\doc2rst\format\CodeBlockFormatter;
use bhenk\doc2rst\format\RestructuredTextFormatter;
use bhenk\doc2rst\tag\InheritdocTag;
use bhenk\doc2rst\tag\TagFactory;
use function count;
use function ctype_space;
use function explode;
use function implode;
use function is_null;
use function preg_match_all;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strpos;
use function strtolower;
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
 * original location in the text. Inline tags begin with :tech:`{\ @` and end with a :tech:`}`. Non-inline tags
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
    private ?string $tag_line = null;
    private bool $end_reached = false;

    /**
     * Constructs a new CommentLexer.
     *
     * @param string $docComment string that starts with :tech:`/**` followed by a whitespace character
     */
    function __construct(private readonly string $docComment,
                         private readonly bool   $ignoreInheritdoc = false) {
        $this->organizer = new CommentOrganizer();
        $this->lex();
    }

    /**
     * @return CommentOrganizer
     */
    public function getCommentOrganizer(): CommentOrganizer {
        return $this->organizer;
    }

    /**
     *
     * @return void
     */
    public function lex(): void {
        $doc = $this->docComment;
        if ($doc and str_starts_with($doc, "/**")) {
            $this->processDoc($doc);
        }
        $this->addSegment($this->organizer);
    }

    private function processDoc(string $doc) {
        $rows = explode(PHP_EOL, $doc);
        if (count($rows) == 1) {
            $this->processSingle($rows);
        } else {
            $this->processMultiple($rows);
        }
        $this->end_reached = true;
        $this->handleSummary("");
        if ($this->tag_line) $this->addTag($this->tag_line);
    }

    private function processSingle(array $rows) {
        $line = substr(trim($rows[0]), 3, -2);
        if (str_starts_with($line, " ")) $line = substr($line, 1);
        if (str_starts_with($line, "@")) {
            $this->addTag($line);
        } else {
            $this->handleSummary($line);
        }
    }

    private function processMultiple(array $rows): void {
        $summary_on = true;
        $code_on = false;
        $tag_on = false;
        for ($i = 1; $i < count($rows) - 1; $i++) {
            $line = substr(trim($rows[$i]), 1);
            if (str_starts_with($line, " ")) $line = substr($line, 1);

            // fork
            if (str_starts_with($line, "```") and !$code_on) $code_on = true;
            if (str_starts_with($line, "@") or $tag_on) {
                $tag_on = $this->handleTag($line);
            } else if ($summary_on) {
                $summary_on = $this->handleSummary($line);
            } elseif ($code_on) {
                $code_on = $this->handleCode($line);
            } else {
                $this->handleLine($line);
            }
        }
    }

    private function handleLine(string $line): void {
        $parts = TagFactory::explodeOnTags($line);
        // TagFactory will not process "{@inheritdoc}"
        $parts = TagFactory::resolveInlineTags($parts);
        $processed = [];
        foreach ($parts as $part) {
            if (strtolower($part) == "{@inheritdoc}") {
                $helper = new CommentHelper();
                $tag = new InheritdocTag();
                $tag->setDescription($helper->getInheritedComment());
                $processed[] = $tag->toRst();
            } else {
                $processed[] = $part;
            }
        }
        $this->organizer->addLine(implode("", $processed));
    }

    private function handleTag(string $line): bool {
        if (str_starts_with($line, "@") and !$this->tag_line) {
            $this->tag_line = $line;
            return true;
        } elseif (ctype_space(substr($line, 0, 2))) {
            $this->tag_line .= " " . trim($line);
            return true;
        } elseif (str_starts_with($line, "@")) {
            $this->addTag($this->tag_line);
            $this->tag_line = $line;
            return true;
        }
        $this->addTag($this->tag_line);
        $this->tag_line = null;
        $this->handleLine($line);
        return false;
    }

    private function addTag(string $line): void {
        if (str_starts_with(strtolower($line), "@inheritdoc") and $this->ignoreInheritdoc) {
            return;
        } elseif (str_starts_with(strtolower($line), "@inheritdoc")) {
            $helper = new CommentHelper();
            $tag = new InheritdocTag();
            $tag->setDescription($helper->getInheritedComment());
            $this->organizer->addTag($tag);
        } else {
            $this->organizer->addTag(TagFactory::getTagImplementation($line));
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
        if ($dot or $white_line or $this->end_reached) {
            $parts = TagFactory::explodeOnTags($this->summary_line);
            $marked = $this->markupSummary($parts);
            $processed = TagFactory::resolveInlineTags($marked);
            $this->organizer->setSummary(implode(" ", $processed));
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
            $this->formatter = new CodeBlockFormatter();
            $this->organizer->addLine($this->formatter);
            return $this->formatter->handleLine($line);
        }
        if (str_starts_with($formatter_name, "rst")) {
            $this->formatter = new RestructuredTextFormatter();
            $this->organizer->addLine($this->formatter);
            return $this->formatter->handleLine($line);
        }
        return false;
    }

    public function markupSummary(array $processed): array {
        $marked = [];
        foreach ($processed as $stub) {
            if (str_starts_with($stub, "{@")) {
                $marked[] = $stub;
            } else {
                $marked[] = self::preserveMarkup($stub);
            }
        }
        return $marked;
    }

    /**
     * Preserve markup in an otherwise *strong* line.
     *
     * Example:
     *
     * ```rst
     * .. code-block::
     *
     *     before: "Preserves italic *null* and ticks ``true`` markup"
     *
     *     after:  "**Preserves italic** *null* **and ticks** ``true`` **markup**"
     * ```
     *
     * @param string $line any string
     * @return string string with **bold** markup and other markup preserved
     */
    public static function preserveMarkup(string $line): string {
        if (trim($line) == "") return "";
        $pattern = '/\s\*(.*?)\*\s/i';
        if (str_starts_with($line, "*")) $line = " " . $line;
        if (str_ends_with($line, "*")) $line = $line . " ";
        if (preg_match_all($pattern, $line, $matches)) {
            foreach ($matches[0] as $match) {
                $line = str_replace($match, "**" . $match . "**", $line);
            }
        }
        if (str_starts_with($line, "** *")) $line = substr($line, 3);
        if (str_ends_with($line, "* **")) $line = substr($line, 0, -3);

        $pattern = '/\s``(.*?)``\s/i';
        if (str_starts_with($line, "``")) $line = " " . $line;
        if (str_ends_with($line, "``")) $line = $line . " ";
        if (preg_match_all($pattern, $line, $matches)) {
            foreach ($matches[0] as $match) {
                $line = str_replace($match, "**" . $match . "**", $line);
            }
        }
        if (str_starts_with($line, "** ``")) $line = substr($line, 3);
        if (str_ends_with($line, "`` **")) $line = substr($line, 0, -3);
        $line = "**" . trim($line) . "**";
        if (str_starts_with($line, "***")) $line = substr($line, 2);
        if (str_ends_with($line, "***")) $line = substr($line, 0, -2);
        if (str_starts_with($line, "**``")) $line = substr($line, 2);
        if (str_ends_with($line, "``**")) $line = substr($line, 0, -2);
        return trim($line);
    }

}