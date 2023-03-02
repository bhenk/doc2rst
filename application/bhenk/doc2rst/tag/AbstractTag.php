<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\log\Log;
use ReflectionClass;
use ReflectionException;
use Stringable;
use function explode;
use function str_ends_with;
use function str_starts_with;
use function strlen;
use function substr;

/**
 * Abstract base class for tags.
 */
abstract class AbstractTag implements Stringable {

    private readonly string $rendered;

    function __construct(protected readonly string $tag_string) {
        $this->rendered = $this->render();
    }

    public abstract function getTagName(): string;

    public abstract function render(): string;

    public function getDisplayName(): string {
        return substr($this->getTagName(), 1);
    }

    /**
     * @return string
     */
    public function getTagString(): string {
        return $this->tag_string;
    }

    public function getLine(): string {
        if (str_starts_with($this->tag_string, "@")) {
            return substr($this->tag_string, strlen(static::getTagName()) + 1);
        } else {
            // inline tag
            return substr($this->tag_string, strlen(static::getTagName()) + 2, -1);
        }
    }

    /**
     * @return string
     */
    public function getRendered(): string {
        return $this->rendered;
    }

    public function __toString(): string {
        return $this->rendered;
    }

    public static function getTagClass(string $tag): AbstractTag {
        $tag_name = explode(" ", $tag)[0];
        if (str_starts_with($tag_name, "{")) $tag_name = substr($tag_name, 1);
        if (str_ends_with($tag_name, "}")) $tag_name = substr($tag_name, 0, -1);
        $class_name = __NAMESPACE__ . "\\" . substr($tag_name, 1) . "Tag";
        try {
            $maybeRC = new ReflectionClass($class_name);
            return $maybeRC->newInstance($tag);
        } catch (ReflectionException) {
            Log::warning("Unknown Tag class: " . $class_name . " for " . $tag
                . " -> " . ProcessState::getCurrentFile());
        }
        return new class($tag) extends AbstractTag {

            public function getTagName(): string {
                return explode(" ", $this->tag_string)[0];
            }

            public function render(): string {
                return $this->getLine();
            }
        };
    }

}