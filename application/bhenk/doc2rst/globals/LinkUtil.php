<?php

namespace bhenk\doc2rst\globals;

use bhenk\doc2rst\log\Log;
use ReflectionClass;
use ReflectionException;
use function addslashes;
use function explode;
use function implode;
use function in_array;
use function is_null;
use function str_replace;
use function strpos;
use function strtolower;
use function substr;

class LinkUtil {

    private static array $data_types = [
        "string",
        "int",
        "float",
        "double",
        "bool",
        "array",
        "object",
        "null",
        "resource",
        "void",
    ];

    public static function resolveType(string $type): string {
        if ($type) {
            $arr = [];
            $types = explode("|", $type);
            foreach ($types as $search) {
                $prefix = "";
                if (str_starts_with($search, "?")) {
                    $search = substr($search, 1);
                    $prefix = "?\ ";
                }
                $arr[] = $prefix . self::renderLink($search, null, false);
            }
            $type = implode(" | ", $arr);
        }
        return $type;
    }

    public static function renderLink(?string $uri, ?string $desc = null,
                                      bool    $try_google = true,
                                      bool    $skip_internals = false): string {
        if (is_null($uri)) return "";
        // data type
        if (in_array(strtolower($uri), self::$data_types)) return $uri;

        $result = self::createLink($uri, $desc);
        if ($result) return $result;

        $name = $uri;
        $method = "";
        $del = strpos($uri, "::");
        if ($del) {
            $name = substr($uri, 0, $del);
            $method = substr($uri, $del);
        }

        $result = self::createReference($name, $method);
        if ($result) return $result;

        if (!$skip_internals) {
            $result = self::createPhpNetLink($desc, $name, $method);
            if ($result) return $result;
        }

        if ($try_google) {
            // last resolve
            if (empty($uri) and empty($desc)) return "";
            if (!empty($uri)) $uri = addslashes($uri);
            if (!empty($desc)) $desc = addslashes($desc);
            $desc = empty($desc) ? $uri : $desc;
            return "`$desc <https://www.google.com/search?q=$uri>`_";
        }
        return $uri;
    }

    public static function createLink(string $uri, ?string $desc): string|bool {
        if (str_starts_with($uri, "http")) {
            // simple
            if (empty($desc)) return $uri;
            // `Link text <https://domain.invalid/>`_
            return "`$desc <$uri>`_";
        }
        return false;
    }

    public static function createReference(string $name, string $method): string|bool {
        $scanned = SourceState::getPhpFiles();

        foreach ($scanned as $class_file) {
            // class_file = name/space/Class.php
            $ns_class = str_replace("/", "\\", substr($class_file, 0, -4));
            $needle = str_contains($name, "\\") ? $name : "\\$name";
            if (str_ends_with($ns_class, $needle)) {
                return ":ref:`$ns_class$method`";
            }
        }
        return false;
    }

    public static function createPhpNetLink(?string $desc, string $name, string $method): string|bool {
        try {
            $class = new ReflectionClass($name);
            if ($class->isInternal()) {
                $link_name = strtolower($name);
                $display_name = empty($desc) ? str_replace("\\", "\\\\", $name . $method) : $desc;
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
        return false;
    }

}