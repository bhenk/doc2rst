<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\log\Log;
use ReflectionClass;
use ReflectionException;
use Stringable;
use function addslashes;
use function explode;
use function str_contains;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strpos;
use function strtolower;
use function substr;

class LinkTag implements Stringable {

    private string $rendered;

    function __construct(string $tag) {
        $this->rendered = $this->render($tag);
    }


    public function render(string $tag): string {
        // {@link [URI] [description]}
        // @link [URI] [description]
        // @see [URI | "FQSEN"] [<description>]
        if (str_starts_with($tag, "{@link")) {
            return self::renderLink(substr($tag, 7, -1));
        } elseif (str_starts_with($tag, "@link")) {
            return self::renderLink(substr($tag, 6));
        } elseif (str_starts_with($tag, "@see")) {
            return self::renderLink(substr($tag, 5));
        } elseif (str_starts_with($tag, "@throws")) {
            return self::renderLink(substr($tag, 8));
        } else {
            Log::error("Unknown tag: " . $tag);
            return $tag;
        }
    }

    public static function renderLink(string $content, bool $skip_internals = false): string {
        $contents = explode(" ", $content);
        $uri = trim($contents[0] ?? "");
        $desc = trim($contents[1] ?? "");
        if (str_starts_with($uri, "http")) {
            // simple
            if ($desc == "") return $uri;           //
            // `Link text <https://domain.invalid/>`_
            return "`$desc <$uri>`_";               //
        }

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
                return ":ref:`$ns_class$method`";         //
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
                    return "`$display_name <$php_net>`_";
                }
            } catch (ReflectionException $e) {
                $rc = ProcessState::getCurrentClass();
                $filename = $rc->getFileName();
                Log::warning("Unresolved link: [" . $e->getMessage() . "] -> " . $filename);
            }
        }
        // last resolve
        $uri = addslashes($uri);
        $desc = addslashes($desc);
        $desc = $desc == "" ? $uri : $desc;
        return "`$desc <https://www.google.com/search?q=$uri>`_";
    }

    public function __toString(): string {
        return $this->rendered;
    }
}