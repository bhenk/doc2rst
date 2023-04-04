<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;
use function str_repeat;
use function strlen;

class Title implements Stringable {

    private static array $levels = [
        0 => "=",
        1 => "+",
        2 => "-",
        3 => "_",
        4 => "*",
        5 => "^",
    ];

    function __construct(private string $title, private int $level = 0) {
        $this->setLevel($this->level);
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     * @noinspection PhpUnused
     */
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    /**
     * @return int
     * @noinspection PhpUnused
     */
    public function getLevel(): int {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void {
        if ($level < 0) $level = 0;
        if ($level > 5) $level = 5;
        $this->level = $level;
    }


    public function __toString(): string {
        return $this->getTitle() . PHP_EOL
            . str_repeat(self::$levels[$this->level], strlen($this->getTitle())) . PHP_EOL;
    }
}