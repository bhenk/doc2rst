<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;
use function array_pad;
use function max;
use function str_repeat;
use function strlen;

class Table implements Stringable {

    private array $rows = [];
    private array $heading;

    function __construct(private readonly int $columns) {}

    public function setHeading(Stringable|string|int|bool...$row): void {
        $this->heading = array_pad($row, $this->columns, "");
    }

    public function addRow(Stringable|string|int|bool...$row): void {
        $this->rows[] = array_pad($row, $this->columns, "");
    }

    public function __toString(): string {
        $max_lengths = array_pad([], $this->columns, 0);
        if (isset($this->heading)) {
            for ($i = 0; $i < $this->columns; $i++) {
                $max_lengths[$i] = max($max_lengths[$i], strlen($this->heading[$i]));
            }
        }
        foreach ($this->rows as $row) {
            for ($i = 0; $i < $this->columns; $i++) {
                $max_lengths[$i] = max($max_lengths[$i], strlen($row[$i]));
            }
        }
        $s = ".. table::" . PHP_EOL
            . "   :widths: auto" . PHP_EOL
            . "   :align: left" . PHP_EOL . PHP_EOL;

        if (isset($this->heading)) {
            $s .= "   ";
            for ($i = 0; $i < $this->columns; $i++) {
                $s .= str_repeat("=", $max_lengths[$i]) . " ";
            }
            $s .= PHP_EOL;
            $s .= "   ";
            for ($i = 0; $i < $this->columns; $i++) {
                $s .= $this->heading[$i]
                    . str_repeat(" ", $max_lengths[$i] - strlen($this->heading[$i])) . " ";
            }
            $s .= PHP_EOL;
        }

        $s .= "   ";
        for ($i = 0; $i < $this->columns; $i++) {
            $s .= str_repeat("=", $max_lengths[$i]) . " ";
        }
        $s .= PHP_EOL;

        foreach ($this->rows as $row) {
            $s .= "   ";
            for ($i = 0; $i < $this->columns; $i++) {
                $s .= $row[$i] . str_repeat(" ", $max_lengths[$i] - strlen($row[$i])) . " ";
            }
            $s .= PHP_EOL;
        }

        $s .= "   ";
        for ($i = 0; $i < $this->columns; $i++) {
            $s .= str_repeat("=", $max_lengths[$i]) . " ";
        }
        $s .= PHP_EOL;

        $s .= PHP_EOL;
        return $s;
    }

}