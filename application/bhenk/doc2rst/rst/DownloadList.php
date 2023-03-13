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
        foreach ($this->entries as $entry) {
            $s .= "* :download:`" . $entry[0] . " <" . $entry[1] . ">`" . PHP_EOL;
        }
        return $s;
    }

    public function addEntry(string $name, string $link) {
        $this->entries[] = [$name, $link];
    }

    public function setCaption(string $caption) {
        $this->caption = $caption;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string {
        return $this->caption;
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
}