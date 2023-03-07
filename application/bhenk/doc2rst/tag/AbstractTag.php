<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

use Stringable;
use function str_starts_with;
use function strlen;
use function substr;

/**
 * Abstract base class for tags.
 */
abstract class AbstractTag implements Stringable {

    function __construct(protected ?string $tag_string = "") {
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

}