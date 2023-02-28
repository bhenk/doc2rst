<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\tag\AbstractTag;
use Stringable;
use function implode;
use function str_starts_with;
use function substr;
use function trim;

class CommentOrganizer implements Stringable {

    private string $summary;
    private array $lines = [];
    private array $tags = [];
    private string $signature;

    private ?string $rendered = null;

    public function render(): string {
        $s = "";
        $order = require "CommentOrder.php";
        foreach ($order as $key => $style) {
            if (str_starts_with($key, "@")) {
                $s .= $this->renderTag($key, $style);
            } else {
                switch ($key) {
                    case "summary":
                        if (!empty($this->summary)) $s .= trim($this->summary) . PHP_EOL . PHP_EOL;
                        break;
                    case "description":
                        if (!empty($this->lines))
                            $s .= implode(PHP_EOL, $this->lines) . PHP_EOL . PHP_EOL;
                        break;
                    case "signature":
                        if (!empty($this->signature)) {
                            $s .= $this->signature;
                        }
                        break;
                }
            }
        }
        $this->rendered = $s;
        return $this->rendered;
    }

    public function renderTag(string $key, string $style): string {
        $s = "";
        if (empty($style)) {
            /** @var AbstractTag $tag */
            foreach ($this->tags as $tag) {
                if ($tag->getTagName() == $key) {
                    $dots = ":";
                    if (empty($tag->__toString())) $dots = "";
                    $s .= "| **" . $key . $dots . "** " . $tag . PHP_EOL;
                }
            }
        } else {
            /** @var AbstractTag $tag */
            foreach ($this->tags as $tag) {
                if ($tag->getTagName() == $key) {
                    $s .= $this->renderStyled($tag, $style);
                }
            }
        }
        return $s;
    }

    public function renderStyled(AbstractTag $tag, string $style): string {
        $argument = "";
        if (str_starts_with($style, "admonition")) {
            $argument = substr($style, 10);
            $style = "admonition";
            if (empty($argument)) $argument = " " . $tag->getTagName();
        }
        $tagName = "**" . $tag->getTagName() . "** ";
        if ($argument == " " . $tag->getTagName()) $tagName = "";
        $content_block = $tagName . $tag->__toString();
        if (empty($content_block)) {
            $content_block = "**" . $tag->getTagName() . "** ";
            Log::warning("Styled " . $tag->getTagName() . " tag without content: "
                . ProcessState::getCurrentFile());
        }

        $s = PHP_EOL . ".. " . $style . "::" . $argument . PHP_EOL . PHP_EOL;
        $s .= "    " . $content_block . PHP_EOL . PHP_EOL;
        return $s;
    }

    /**
     *
     */
    public function __toString(): string {
        if (is_null($this->rendered)) {
            Log::error("call " . self::class . "::render() before __toString!!");
            return "call " . self::class . "::render() before __toString!!";
        }
        return $this->rendered;
    }

    /**
     * @return string
     */
    public function getSummary(): string {
        return $this->summary;
    }

    /**
     * @param Stringable|string $summary
     */
    public function setSummary(Stringable|string $summary): void {
        $this->summary = $summary;
    }

    /**
     * @return array
     */
    public function getLines(): array {
        return $this->lines;
    }

    /**
     * @param array $lines
     */
    public function setLines(array $lines): void {
        $this->lines = $lines;
    }

    public function addLine(Stringable|string $line): void {
        $this->lines[] = $line;
    }

    /**
     * @return string
     */
    public function getSignature(): string {
        return $this->signature;
    }

    /**
     * @param string $signature
     */
    public function setSignature(string $signature): void {
        $this->signature = $signature;
    }

    /**
     * @return array
     */
    public function getTags(): array {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void {
        $this->tags = $tags;
    }

    public function addTag(AbstractTag $tag): void {
        $this->tags[] = $tag;
    }

    public function getTagsByName(string $name): array {
        $tags = [];
        /** @var AbstractTag $tag */
        foreach ($this->tags as $tag) {
            if ($tag->getTagName() == $name) $tags[] = $tag;
        }
        return $tags;
    }

}