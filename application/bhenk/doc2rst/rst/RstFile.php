<?php

namespace bhenk\doc2rst\rst;

use bhenk\doc2rst\globals\RunConfiguration;
use Stringable;
use function file_put_contents;

class RstFile implements Stringable {

    private static int $counter = 0;

    private array $entries = [];

    function __construct(private readonly string $filename) {}

    public function putContents() {
        $f = RunConfiguration::getApiDirectory() . DIRECTORY_SEPARATOR . $this->filename . ".rst";
        file_put_contents($f, $this->__toString());
    }

    /**
     * @inheritDoc
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

    public function addEntry(Stringable $entry): Stringable {
        $this->entries[] = $entry;
        return $entry;
    }
}