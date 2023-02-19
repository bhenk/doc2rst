<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\model\DocCommentReaderInterface;
use bhenk\doc2rst\tag\LinkTag;
use function explode;
use function str_contains;
use function str_ends_with;
use function str_starts_with;
use function strlen;
use function strpos;
use function substr;

class DocCommentReader implements DocCommentReaderInterface {


    public function readDoc(string $doc): string {
        $s = "";
        if (str_starts_with($doc, "/**")) {
            $s .= $this->processDoc($doc);
        }
        return $s;
    }

    public function processDoc(string $doc): string {
        $s = "";
        $rows = explode(PHP_EOL, $doc);
        for ($i = 1; $i < count($rows) - 1; $i++) {
            $start = strpos($rows[$i], "* ");
            $line = substr($rows[$i], $start + 2);
            if ($i == 1) {
                $s .= $this->processFirstLine($line);
            } else {
                $s .= $this->processLine($line) . PHP_EOL;
            }
        }
        return $s;
    }

    public function processLine(string $line): string {
        if (str_contains($line, "{@link")) {
            while (str_contains($line, "{@link")) {
                $sl = strpos($line, "{@link");
                $el = strpos($line, "}") + 1;
                $link_tag = substr($line, $sl, $el - $sl);
                $link = (new LinkTag())->render($link_tag);
                $first = substr($line, 0, $sl - 1) . " ";
                if (str_starts_with($line, "{@link")) $first = "";
                $last = substr($line, $el);
                $line = "$first$link $last";
            }
            return $line;
        }
        if (str_contains($line, "@link")) {
            $sl = strpos($line, "@link");
            $link_tag = substr($line, $sl);
            $link = (new LinkTag())->render($link_tag);
            return "| **see     :** $link";
        }
        if (str_contains($line, "@see")) {
            $sl = strpos($line, "@see");
            $link_tag = substr($line, $sl);
            $link = (new LinkTag())->render($link_tag);
            return "| **see also:** $link";
        }
        return $line;
    }

    public function processFirstLine(string $line): string {
        if (str_contains($line, "{@link")) {
            return $this->processFirstLineLinkTag($line);
        }
        if (str_contains($line, "http://")) {
            return $this->processFirstLineLink($line);
        }
        $end = strpos($line, ".");
        if ($end) $line = substr($line, 0, $end);
        $line = trim($line);
        return "**$line**" . PHP_EOL . PHP_EOL;
    }

    public function processFirstLineLinkTag(string $line): string {
        $sl = strpos($line, "{@link");
        $el = strpos($line, "}") + 1;
        $link_tag = substr($line, $sl, $el - $sl);
        $link = (new LinkTag())->render($link_tag);
        $first = substr($line, 0, $sl - 1);
        if (strlen($first) > 0) $first = "**$first** ";
        $last = substr($line, $el + 1);
        $end = strpos($last, ".");
        if ($end) $last = substr($last, 0, $end);
        $last = trim($last);
        if (strlen($last) > 0) $last = " **$last**";
        return "$first$link$last" . PHP_EOL . PHP_EOL;
    }

    public function processFirstLineLink(string $line): string {
        $sl = strpos($line, "http://");
        $line_start = "**" . substr($line, 0, $sl - 1) . "**";
        $link = substr($line, $sl);
        if (str_ends_with($link, ".")) $link = substr($link, 0, strlen($link) - 1);
        $el = strpos($link, " ");
        $line_end = "";
        if ($el) {
            $line_end = " **" . trim(substr($link, $el + 1)) . "**";
            $link = substr($link, 0, $el);
        }

        return "$line_start $link" . $line_end . PHP_EOL . PHP_EOL;
    }
}