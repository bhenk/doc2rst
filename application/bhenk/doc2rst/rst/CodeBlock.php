<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;
use function implode;
use function str_contains;

class CodeBlock implements Stringable {

    private array $lines = [];
    private string $current_part = "";

    function __construct(private string $taste = "php") {}

    /**
     *
     */
    public function __toString(): string {
        $s = PHP_EOL . ".. code-block:: " . $this->taste . PHP_EOL . PHP_EOL;
        $s .= "    " . implode(PHP_EOL . "    ", $this->lines);
        return $s . PHP_EOL . PHP_EOL;
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

    public function addPart(Stringable|string $part): void {
        $this->current_part .= $part;
        if (str_contains($part, PHP_EOL)) {
            $this->addLine($this->current_part);
            $this->current_part = "";
        }
    }

    /**
     * @return string
     */
    public function getTaste(): string {
        return $this->taste;
    }

    /**
     * @param string $taste
     */
    public function setTaste(string $taste): void {
        $this->taste = $taste;
    }
}