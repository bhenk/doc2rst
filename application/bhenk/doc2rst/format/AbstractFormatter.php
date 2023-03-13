<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\format;

use Stringable;
use function implode;

/**
 * Formatters transform specific PHPDoc-blocks to reStructuredText
 */
abstract class AbstractFormatter implements Stringable {

    private int $line_count = 0;
    private array $lines = [];

    /**
     * Handle a line of PHPDoc
     *
     * As long as the formatter wants more lines it should return *true*. When it has enough it should return *false*.
     *
     * @param string $line line to format
     * @return bool *true* if more lines are welcome, *false* otherwise
     */
    public abstract function handleLine(string $line): bool;

    /**
     * Add a line to the resulting block
     * @param string|Stringable $line the line to add
     * @return void
     */
    protected function addLine(string|Stringable $line): void {
        $this->lines[] = $line;
    }

    /**
     * Returns a reStructuredText representation of the contents of the block
     * @return string reStructuredText representation of the contents
     */
    public function __toString(): string {
        return implode(PHP_EOL, $this->lines);
    }

    /**
     * @return int
     */
    protected function getLineCount(): int {
        return $this->line_count;
    }

    protected function increaseLineCount(): int {
        return $this->line_count++;
    }

}