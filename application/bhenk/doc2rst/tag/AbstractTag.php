<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\log\Log;
use ReflectionClass;
use ReflectionException;
use Stringable;
use function str_contains;
use function str_starts_with;
use function strlen;
use function strpos;
use function substr;

abstract class AbstractTag implements Stringable {

    private readonly string $rendered;

    function __construct(protected readonly string $tag) {
        $this->rendered = $this->render();
    }

    public abstract function getTagName(): string;

    public abstract function render(): string;

    /**
     * @return string
     */
    public function getTag(): string {
        return $this->tag;
    }

    public function getLine(): string {
        if (str_starts_with($this->tag, "@")) {
            return substr($this->tag, strlen(static::getTagName()) + 1);
        } else {
            return substr($this->tag, strlen(static::getTagName()) + 2, -1);
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
        if (str_contains($tag, "link")) return new LinkTag($tag);
        if (str_contains($tag, "param")) return new ParamTag($tag);
        if (str_contains($tag, "return")) return new ReturnTag($tag);
        if (str_contains($tag, "see")) return new SeeTag($tag);
        if (str_contains($tag, "throws")) return new ThrowsTag($tag);

        Log::warning("Unknown tag: " . $tag
            . " -> " . ProcessState::getCurrentFile());
        return new class($tag) extends AbstractTag {

            public function getTagName(): string {
                return "@unknown";
            }

            public function render(): string {
                return "cannot be rendered: " . $this->tag;
            }
        };
    }

    public static function renderLink(string $content, bool $skip_internals = false): string {
        // @link [URI] [description]
        $contents = explode(" ", $content);
        $uri = trim($contents[0] ?? "");
        $desc = trim($contents[1] ?? "");
        return self::renderFullLink($uri, $desc, $skip_internals);
    }

    public static function renderFullLink(string $uri, string $desc, bool $skip_internals = false): string {
        if (str_starts_with($uri, "http")) {
            // simple
            if ($desc == "") return $uri;           // return
            // `Link text <https://domain.invalid/>`_
            return "`$desc <$uri>`_";               // return
        }

        // reference
        $scanned = SourceState::getPhpFiles();
        $name = $uri;
        $method = "";
        $del = strpos($uri, "::");
        if ($del) {
            $name = substr($uri, 0, $del);
            $method = substr($uri, $del);
        }

        foreach ($scanned as $class_file) {
            // class_file = name/space/Class.php
            $ns_class = str_replace("/", "\\", substr($class_file, 0, -4));
            $needle = str_contains($name, "\\") ? $name : "\\$name";
            if (str_ends_with($ns_class, $needle)) {
                return ":ref:`$ns_class$method`";     // return
            }
        }

        if (!$skip_internals) {
            // internal class
            try {
                $class = new ReflectionClass($name);
                if ($class->isInternal()) {
                    $link_name = strtolower($name);
                    $display_name = $desc == "" ? str_replace("\\", "\\\\", $name . $method) : $desc;
                    $php_net = "https://www.php.net/manual/en/class.$link_name" . ".php";
                    // {@link OutOfBoundsException::getMessage()}
                    // {@link Attribute::TARGET_CLASS} constants on same page...
                    if (str_starts_with($method, "::") and str_ends_with($method, "()")) {
                        $method = "." . strtolower(substr($method, 2, -2));
                        $php_net = "https://www.php.net/manual/en/$link_name$method" . ".php";
                    }
                    return "`$display_name <$php_net>`_";   // return
                }
            } catch (ReflectionException $e) {
                Log::warning("Unresolved link: [" . $e->getMessage() . "] -> "
                    . ProcessState::getCurrentFile());
            }
        }
        // last resolve
        $uri = addslashes($uri);
        $desc = addslashes($desc);
        $desc = $desc == "" ? $uri : $desc;
        return "`$desc <https://www.google.com/search?q=$uri>`_";
    }
}