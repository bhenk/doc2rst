<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\D2R;
use Stringable;
use function str_starts_with;
use function strlen;
use function substr;

/**
 * Abstract base class for tags.
 */
abstract class AbstractTag implements Stringable {

    private int $tag_length;
    private int $group_width = -1;

    function __construct(protected ?string $tag_string = "") {
        $this->tag_length = strlen($this->getTagName()) - 1;
        $this->render();
    }

    public function getTagString(): string {
        return $this->tag_string;
    }

    public abstract function getTagName(): string;

    public abstract function render(): void;

    public function getDisplayName(): string {
        return substr($this->getTagName(), 1);
    }

    public function getLine(): string {
        if ($this->isInline()) {
            return substr($this->tag_string, strlen(static::getTagName()) + 2, -1);
        } else {
            return substr($this->tag_string, strlen(static::getTagName()) + 1);
        }
    }

    public function isInline(): bool {
        return str_starts_with($this->tag_string, "{@");
    }

    /**
     * @return int
     */
    public function getTagLength(): int {
        return $this->tag_length;
    }

    /**
     * @return int
     */
    public function getGroupWidth(): int {
        return $this->group_width;
    }

    public function setGroupWidth(int $max_width): void {
        $this->group_width = $max_width;
    }

    public function getRole(): string {
        if ($this->isInline()) return "tag0";
        $max = max($this->tag_length, $this->group_width);
        if ($max <= 12 and $max >= 3) return "tag" . $max;
        return "tag0";
    }

    public function toRst(): string {
        $style = D2R::getTagStyle($this->getTagName());
        if ($style == "") {
            return $this->toPlainRst();
        } else {
            //
            return $this->getTagName() . " " . $this->__toString();
        }
    }

    public function toPlainRst(): string {
        if ($this->isInline()) return ":tag0:`" . $this->getDisplayName() . "` " . $this->__toString();
        return "| :" . $this->getRole() . ":`" . $this->getDisplayName() . "` " . $this->__toString() . PHP_EOL;
    }

}