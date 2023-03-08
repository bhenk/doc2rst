<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;
use function basename;
use function dirname;
use function file_put_contents;
use function is_dir;
use function mkdir;

class RstFile implements Stringable {

    private static int $counter = 0;

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

    public function setDirectory(string $dir): void {
        $this->filename = $dir . DIRECTORY_SEPARATOR . basename($this->filename);
    }

    public function putContents(): void {
        $dir = dirname($this->filename);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($this->filename, $this);
    }

    /**
     *
     */
    public function __toString(): string {
        return implode(PHP_EOL, $this->entries);
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

    public function addEntry(string|Stringable $entry): string|Stringable {
        $this->entries[] = $entry;
        return $entry;
    }

}