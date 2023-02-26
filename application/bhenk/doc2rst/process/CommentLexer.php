<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\tag\AbstractTag;
use ReflectionMethod;
use function count;
use function explode;
use function implode;
use function preg_match_all;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strpos;
use function substr;

class CommentLexer extends AbstractLexer {

    private DocComment $comment;

    function __construct(private readonly ReflectionMethod $method) {
        $this->comment = new DocComment();
        $this->lex();
    }

    /**
     * @return DocComment
     */
    public function getDocComment(): DocComment {
        return $this->comment;
    }

    public function lex(): void {
        $doc = $this->method->getDocComment();
        if ($doc and str_starts_with($doc, "/**")) {
            $this->processDoc($doc);
        }
        $this->addSegment($this->comment);
    }

    private function processDoc(string $doc) {
        $rows = explode(PHP_EOL, $doc);
        for ($i = 1; $i < count($rows) - 1; $i++) {
            $line = substr(trim($rows[$i]), 2);
            if ($i == 1) {
                $line = substr($line, 0, strpos($line, "."));
            }
            if (str_starts_with($line, "@")) {
                $this->processTag($line);
            } else {
                $parts = self::splitLine($line, []);
                if ($i == 1) $parts = self::makeStrongParts($parts);
                $processed = $this->resolveInlineTags($parts);
                if ($i == 1) {
                    $this->setSummary($processed);
                } else {
                    $this->comment->addLine(implode("", $processed));
                }
            }
        }
    }

    private function setSummary(array $processed) {
        $line = self::preserveMarkup(implode(" ", $processed));
        $line = str_replace("****", "", $line);
        $this->comment->setSummary($line);
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
        $this->comment->addTag(AbstractTag::getTagClass($line));
    }


    /**
     * Markup parts with ``strong`` inline markup.
     *
     * Inline tags (``{@tagname}``) will **not** be treated.
     *
     * @param array $parts
     * @return array
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
     * @param string $line
     * @return string
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
     * @param string $line
     * @param array $parts
     * @return array
     */
    public static function splitLine(string $line, array $parts): array {
        $pos1 = strpos($line, "{@");
        $pos2 = strpos($line, "}");
        if ($pos1 and $pos2) {
            $parts[] = substr($line, 0, $pos1);
            $parts[] = substr($line, $pos1, ($pos2 - $pos1) + 1);
            $line = substr($line, $pos2 + 1);
            return self::splitLine($line, $parts);
        } else {
            $parts[] = $line;
        }
        return $parts;
    }

}