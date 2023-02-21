<?php

namespace bhenk\doc2rst\rst;

use Stringable;
use function in_array;

class TocTree implements Stringable {


    private int $max_depth = -1;
    private ?string $caption = null;
    private ?string $name = null;

    function __construct(private array $entries = []) {}

    public function __toString(): string {
        $s = ".. toctree::" . PHP_EOL;
        if ($this->max_depth > -1) $s .= "   :maxdepth: " . $this->max_depth . PHP_EOL;
        if ($this->caption) $s .= "   :caption: " . $this->caption . PHP_EOL;
        if ($this->name) $s .= "   :name: " . $this->name . PHP_EOL;
        $s .= PHP_EOL;
        foreach ($this->entries as $entry) {
            $s .= "   " . $entry . PHP_EOL;
        }
        return $s;
    }

    public function addEntry(string $entry): void {
        if (!in_array($entry, $this->entries))
            $this->entries[] = $entry;
    }

    /**
     * @return array
     */
    public function getEntries(): array {
        return $this->entries;
    }

    /**
     * @param array $entries
     */
    public function setEntries(array $entries): void {
        $this->entries = $entries;
    }

    /**
     * @return int
     */
    public function getMaxDepth(): int {
        return $this->max_depth;
    }

    /**
     * @param int $max_depth
     */
    public function setMaxDepth(int $max_depth): void {
        $this->max_depth = $max_depth;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string {
        return $this->caption;
    }

    /**
     * @param string|null $caption
     */
    public function setCaption(?string $caption): void {
        $this->caption = $caption;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void {
        $this->name = $name;
    }
}