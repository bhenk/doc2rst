<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;
use function is_null;

class TocTree implements Stringable {

    private ?string $caption = null;
    private ?string $name = null;
    private int $max_depth = -1;
    private bool $titles_only = false;

    function __construct(private array $entries = []) {}

    public function isEmpty(): bool {
        return empty($this->entries);
    }

    public function __toString(): string {
        if (empty($this->entries)) return "";
        $s = ".. toctree::" . PHP_EOL;
        if ($this->max_depth > -1) $s .= "   :maxdepth: " . $this->max_depth . PHP_EOL;
        if ($this->titles_only) $s .= "   :titlesonly:" . PHP_EOL;
        if ($this->caption) $s .= "   :caption: " . $this->caption . PHP_EOL;
        if ($this->name) $s .= "   :name: " . $this->name . PHP_EOL;
        $s .= PHP_EOL;
        foreach ($this->entries as $entry) {
            $s .= "   " . $entry . PHP_EOL;
        }
        return $s;
    }

    public function addEntry(string $link, ?string $title = null): void {
        if (!is_null($title)) {
            $link = $title . " <" . $link . ">";
        }
        $this->entries[] = $link;
    }

    /**
     * @return array
     * @noinspection PhpUnused
     */
    public function getEntries(): array {
        return $this->entries;
    }

    /**
     * @param array $entries
     * @noinspection PhpUnused
     */
    public function setEntries(array $entries): void {
        $this->entries = $entries;
    }

    /**
     * @return int
     * @noinspection PhpUnused
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
     * @noinspection PhpUnused
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

    /**
     * @return bool
     * @noinspection PhpUnused
     */
    public function isTitlesOnly(): bool {
        return $this->titles_only;
    }

    /**
     * @param bool $titles_only
     */
    public function setTitlesOnly(bool $titles_only): void {
        $this->titles_only = $titles_only;
    }
}