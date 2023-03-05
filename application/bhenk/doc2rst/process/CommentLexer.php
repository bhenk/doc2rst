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

class CommentLexer extends AbstractLexer {

    private CommentOrganizer $organizer;
    private ?AbstractFormatter $formatter = null;

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
        $modus_code = false;
        for ($i = 1; $i < count($rows) - 1; $i++) {
            $line = substr(trim($rows[$i]), 2);
            if (str_starts_with($line, "```") and !$modus_code) $modus_code = true;
            if ($modus_code) {
                $modus_code = $this->handleCode($line);
                if (!$modus_code) $this->formatter = null;
            } else if (str_starts_with($line, "@")) {
                $this->organizer->addTag(TagFactory::getTagClass($line));
            } else {
                if ($i == 1) {
                    $dot = strpos($line, ".");
                    if ($dot) $line = substr($line, 0, $dot);
                }
                $parts = TagFactory::explodeOnTags($line);
                if ($i == 1) $parts = self::makeStrongParts($parts);
                $processed = TagFactory::resolveInlineTags($parts);
                if ($i == 1) {
                    $this->setSummary($processed);
                } else {
                    $this->organizer->addLine(implode("", $processed));
                }
            }
        }
    }

    private function handleCode(string $line): bool {
        if (!is_null($this->formatter)) return $this->formatter->handleLine($line);
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

    private function setSummary(array $processed) {
        $line = self::preserveMarkup(implode(" ", $processed));
        $line = str_replace("****", "", $line);
        $this->organizer->setSummary($line);
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