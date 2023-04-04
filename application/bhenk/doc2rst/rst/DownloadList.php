<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;

class DownloadList implements Stringable {

//downloads
//+++++++++
//
//* :download:`d2r-styles.txt <d2r-styles.txt>`

    private array $entries = [];

    function __construct(private ?string $caption = null) {}

    public function isEmpty(): bool {
        return empty($this->entries);
    }

    public function __toString(): string {
        if (empty($this->entries)) return "";
        $s = "";
        if ($this->caption) {
            $s .= new Title($this->caption, 2);
        }
        $s .= PHP_EOL;
        foreach ($this->entries as $link => $name) {
            $s .= "* :download:`" . $name. " <" . $link . ">`" . PHP_EOL;
        }
        return $s;
    }

    public function addEntry(string $name, string $link): void {
        $this->entries[$link] = $name;
    }

    /** @noinspection PhpUnused */
    public function setCaption(string $caption): void {
        $this->caption = $caption;
    }

    /**
     * @return string|null
     * @noinspection PhpUnused
     */
    public function getCaption(): ?string {
        return $this->caption;
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
}