<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\format\AbstractFormatter;
use bhenk\doc2rst\format\RestructuredTextFormatter;
use bhenk\doc2rst\tag\AbstractTag;
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

    function __construct(private readonly ReflectionMethod $method) {
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
        $doc = $this->method->getDocComment();
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
            } else if (str_starts_with($line, "@")) {
                $this->processTag($line);
            } else {
                if ($i == 1) $line = substr($line, 0, strpos($line, "."));
                $parts = self::explodeOnTags($line);
                if ($i == 1) $parts = self::makeStrongParts($parts);
                $processed = $this->resolveInlineTags($parts);
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

    private function resolveInlineTags(array $parts): array {
        $processed = [];
        foreach ($parts as $part) {
            if (str_starts_with($part, "{@")) {
                if (str_ends_with($part, ".")) $part = substr($part, 0, -1);
                $processed[] = $this->processInlineTag($part);
            } else {
                $processed[] = $part;
            }
        }
        return $processed;
    }

    private function processInlineTag(string $tag): string {
        return AbstractTag::getTagClass($tag);
    }

    private function processTag(string $line) {
        $this->organizer->addTag(AbstractTag::getTagClass($line));
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
        $pattern = '{\s\*\w+\*\s}';
        if (preg_match_all($pattern, $line, $matches)) {
            foreach ($matches[0] as $match) {
                $line = str_replace($match, "**" . $match . "**", $line);
            }
        }
        // inline literal (red on white)
        $pattern = '{\s``\w+``\s}';
        if (preg_match_all($pattern, $line, $matches)) {
            foreach ($matches[0] as $match) {
                $line = str_replace($match, "**" . $match . "**", $line);
            }
        }
        return $line;
    }

    /**
     * Split a line on inline tags.
     *
     * This is a recursive function. Example:
     *
     * ```rst
     * .. code-block::
     *
     *     before: "Gets the {@link BarClass} out of the {@link Foo::method}"
     *
     *     after : ["Gets the ", "{@link BarClass}", " out of the ", "{@link Foo::method}"]
     * ```
     *
     * @param string $line any string
     * @param array $parts optional - any array
     * @return array with ``$line`` exploded on inline tags
     */
    public static function explodeOnTags(string $line, array $parts = []): array {
        $pos1 = strpos($line, "{@");
        $pos2 = strpos($line, "}");
        if ($pos1 and $pos2) {
            $parts[] = substr($line, 0, $pos1);
            $parts[] = substr($line, $pos1, ($pos2 - $pos1) + 1);
            $line = substr($line, $pos2 + 1);
            return self::explodeOnTags($line, $parts);
        } else {
            if (!empty($line)) $parts[] = $line;
        }
        return $parts;
    }

}