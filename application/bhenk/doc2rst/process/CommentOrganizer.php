<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\D2R;
use bhenk\doc2rst\tag\TagInterface;
use Stringable;
use function array_keys;
use function array_merge;
use function array_search;
use function array_slice;
use function implode;
use function max;
use function str_starts_with;
use function trim;

class CommentOrganizer implements Stringable {

    private string $summary;
    private array $lines = [];
    private array $tags = [];
    private string $signature;
    private array $element_order = [];
    private ?string $rendered = null;

    function __construct(private bool $indented = false) {}

    /**
     * @return bool
     */
    public function isIndented(): bool {
        return $this->indented;
    }

    /**
     * @param bool $indented
     */
    public function setIndented(bool $indented): void {
        $this->indented = $indented;
    }

    public function setOrder() {
        $order = D2R::getCommentOrder();
        $this->element_order = [];
        $tag_count = 0;
        $styled_count = 0;
        foreach ($order as $key => $style) {
            if (str_starts_with($key, "@")) {
                /** @var TagInterface $tag */
                foreach ($this->tags as $tag) {
                    if ($tag->getTagName() == $key) {
                        if (empty($style)) {
                            $this->element_order["tag" . $tag_count++] = $tag;
                        } else {
                            $this->element_order["styled" . $styled_count++] = $tag;
                        }
                    }
                }
                $this->removeTagsByName($key);
            } else {
                switch ($key) {
                    case "unknown_tags":
                        $this->element_order["unknown_tags"] = "";
                        break;
                    case "summary":
                        if (isset($this->summary))
                            $this->element_order["summary"] = $this->getSummary();
                        break;
                    case "description":
                        if (!empty($this->getLines()))
                            $this->element_order["lines"] = $this->getLines();
                        break;
                    case "signature":
                        if (isset($this->signature))
                            $this->element_order["signature"] = $this->getSignature();
                        break;
                }
            }
        }
        // unknown tags (left in array)
        $pos = array_search("unknown_tags", array_keys($this->element_order));
        $top = array_slice($this->element_order, 0, $pos);
        $bottom = array_slice($this->element_order, $pos + 1);
        /** @var TagInterface $tag */
        foreach ($this->tags as $tag) {
            $top["tag" . $tag_count++] = $tag;
        }
        $this->element_order = array_merge($top, $bottom);
    }

    public function render(): string {
        $s = "";
        $this->setOrder();
        $max_width = -1;
        $last_tag = null;
        /**
         * @var  $key string
         * @var  $element TagInterface|string|array
         */
        foreach ($this->element_order as $key => $element) {
            if (str_starts_with($key, "tag")) {
                if ($max_width == -1) {
                    // lookahead to find max width of tag group
                    $record = false;
                    /**
                     * @var  $k string
                     * @var  $v TagInterface|string|array
                     */
                    foreach ($this->element_order as $k => $v) {
                        if ($k == $key) $record = true;
                        if ($record and str_starts_with($k, "tag")) {
                            if ($v->getTagLength() <= 12)
                                $max_width = max($max_width, $v->getTagLength());
                            $last_tag = $k;
                        } else if ($record and !str_starts_with($k, "tag")) {
                            break;
                        }
                    }
                }
                $element->setGroupWidth($max_width);
                $s .= $element->toRst();
                if ($key == $last_tag) {
                    $last_tag = null;
                    $max_width = -1;
                    $s .= PHP_EOL;
                }
            } else if (str_starts_with($key, "styled")) {
                $s .= $element->toRst();
            } else if ($key == "summary") {
                $s .= PHP_EOL . trim($this->summary) . PHP_EOL . PHP_EOL;
            } else if ($key == "lines") {
                $s .= PHP_EOL . implode(PHP_EOL, $this->lines) . PHP_EOL . PHP_EOL;
            } else if ($key == "signature") {
                $s .= $this->signature;
            }
        }
        $this->rendered = $s;
        return $this->rendered;
    }

    /**
     *
     */
    public function __toString(): string {
        if (is_null($this->rendered)) {
            $this->render();
        }
        if ($this->indented) {
            $all = explode(PHP_EOL, $this->rendered);
            $this->rendered = implode(PHP_EOL . "   ", $all);
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

    public function addTag(TagInterface $tag): void {
        $this->tags[] = $tag;
    }

    public function getTagsByName(string $tagname): array {
        $tags = [];
        /** @var TagInterface $tag */
        foreach ($this->tags as $tag) {
            if ($tag->getTagName() == $tagname) $tags[] = $tag;
        }
        return $tags;
    }

    public function removeTagsByName(string $tagname): array {
        $remains = [];
        $removes = [];
        /** @var TagInterface $tag */
        foreach ($this->tags as $tag) {
            if ($tag->getTagName() == $tagname) {
                $removes[] = $tag;
            } else {
                $remains[] = $tag;
            }
        }
        $this->tags = $remains;
        return $removes;
    }

}