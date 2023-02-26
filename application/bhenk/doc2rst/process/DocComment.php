<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\tag\AbstractTag;
use bhenk\doc2rst\tag\LinkTag;
use bhenk\doc2rst\tag\ReturnTag;
use bhenk\doc2rst\tag\SeeTag;
use bhenk\doc2rst\tag\ThrowsTag;
use Stringable;
use function implode;
use function trim;

class DocComment implements Stringable {

    private const NL2 = PHP_EOL . PHP_EOL;

    private string $summary = "";
    private array $lines = [];
    private array $tags = [];
    private string $signature;

    /**
     * @inheritDoc
     */
    public function __toString(): string {
        $standardTags = $this->getStandardTags();
        $s = "";
        if (!empty($this->summary)) $s .= trim($this->summary) . self::NL2;
        if (!empty($this->lines))
            $s .= implode(PHP_EOL, $this->lines) . PHP_EOL . PHP_EOL;

        // not standard tags.
        $s .= $standardTags;
        $s .= PHP_EOL;
        return $s;
    }

    private function getStandardTags(): string {
        $s = "";
        $nl = false;
        foreach ($this->tags as $key => $tag) {
            if ($tag->getTagName() == LinkTag::TAG) {
                $s .= "| **@link:** " . $tag . PHP_EOL;
                //unset($this->tags, $key);
                $nl = true;
            }
        }
        foreach ($this->tags as $key => $tag) {
            if ($tag->getTagName() == SeeTag::TAG) {
                $s .= "| **@see also:** " . $tag . PHP_EOL;
                //unset($this->tags, $key);
                $nl = true;
            }
        }
        if ($nl) $s .= PHP_EOL;
        // signature //////////////
        $s .= $this->signature;
        //////////////////////////
        foreach ($this->tags as $key => $tag) {
            if ($tag->getTagName() == "@param") {
                $s .= "| **@param:** " . $tag . PHP_EOL;
                //unset($this->tags, $key);
            }
        }
        foreach ($this->tags as $key => $tag) {
            if ($tag->getTagName() == ReturnTag::TAG) {
                $s .= "| **@return:** " . $tag . PHP_EOL;
                //unset($this->tags, $key);
            }
        }
        foreach ($this->tags as $key => $tag) {
            if ($tag->getTagName() == ThrowsTag::TAG) {
                $s .= "| **@throws:** " . $tag . PHP_EOL;
                //unset($this->tags, $key);
            }
        }
        return $s;
    }

    private function getOtherTags(): string {
        $s = "";

        return $s;
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

}