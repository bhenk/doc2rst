<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use bhenk\doc2rst\globals\DocState;
use Stringable;
use function basename;
use function dirname;
use function file_put_contents;
use function is_dir;
use function mkdir;

class Document implements Stringable {

    private array $entries = [];

    function __construct(private string $filename) {}

    /**
     * @return string
     */
    public function getFilename(): string {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void {
        $this->filename = $filename;
    }

    /** @noinspection PhpUnused */
    public function setDirectory(string $dir): void {
        $this->filename = $dir . DIRECTORY_SEPARATOR . basename($this->filename);
    }

    public function putContents(): void {
        $dir = dirname($this->filename);
        DocState::addAbsoluteDir($dir);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($this->filename, $this);
        DocState::addAbsoluteFile($this->filename);
    }

    /**
     *
     */
    public function __toString(): string {
        return implode(PHP_EOL, $this->entries);
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

    public function addEntry(string|Stringable $entry): string|Stringable {
        $this->entries[] = $entry;
        return $entry;
    }

}