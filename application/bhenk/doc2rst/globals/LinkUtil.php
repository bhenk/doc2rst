<?php

namespace bhenk\doc2rst\globals;

use bhenk\doc2rst\log\Log;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionType;
use ReflectionUnionType;
use function addslashes;
use function array_key_exists;
use function end;
use function explode;
use function file_get_contents;
use function implode;
use function in_array;
use function is_null;
use function str_contains;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strpos;
use function strtolower;
use function substr;

class LinkUtil {

    const PHP_CLASS_NET = "https://www.php.net/manual/en/class";
    const SEARCH_ENGINE = "https://www.google.com/search?q=";

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
        "static",
        "mixed",
        "self",
    ];

    public static function resolveReflectionType(ReflectionType $reflectionType): string {
        if ($reflectionType instanceof ReflectionNamedType) {
            $name = $reflectionType->getName();
            $allowsNull = ($reflectionType->allowsNull() and ($name != "null") and ($name != "mixed")) ? "?\ " : "";
            // Checks if the type is a built-in type in PHP.
            // A built-in type is any type that is not a class, interface, or trait.
            $builtin = $reflectionType->isBuiltin();
            if ($builtin or $name == "self" or $name == "static") {
                return $allowsNull . $name;
            }
            $result = self::createDocumentedClassReference($reflectionType);
            if ($result) return $allowsNull . $result;

            $result = self::createInternalClassLink($reflectionType);
            if ($result) return $allowsNull . $result;

            $result = self::createUserProvidedLink($reflectionType);
            if ($result) return $allowsNull . $result;

            $result = self::createSourceLink($reflectionType);
            if ($result) return $allowsNull . $result;

            $result = self::createSearchEngineLink($reflectionType);
            if ($result) return $allowsNull . $result;

            return $allowsNull . addslashes($name);

        } elseif ($reflectionType instanceof ReflectionUnionType) {
            // Union types and the nullable type notation cannot be mixed
            // So once here, $allowsNull in the above is always ""
            $results = [];
            foreach ($reflectionType->getTypes() as $reflectionNamedType) {
                $results[] = self::resolveReflectionType($reflectionNamedType);
            }
            return implode(" | ", $results);
        } else {
            Log::warning("Cannot handle " . $reflectionType::class);
            return "unknown";
        }
    }

    public static function createDocumentedClassReference(ReflectionNamedType $reflectionNamedType): string|bool {
        $fqn = $reflectionNamedType->getName();
        $rel_filename = str_replace("\\", DIRECTORY_SEPARATOR, $fqn) . ".php";
        $scouted = SourceState::getPhpFiles();
        if (in_array($rel_filename, $scouted)) {
            return ":ref:`$fqn`";
        }
        return false;
    }

    public static function createInternalClassLink(ReflectionNamedType $reflectionNamedType): string|bool {
        $fqn = $reflectionNamedType->getName();
        try {
            $class = new ReflectionClass($fqn);
            if (!$class->isInternal()) return false;
            $link_name = strtolower($fqn);
            $display_name = $class->getShortName();
            $php_net = self::PHP_CLASS_NET . ".$link_name.php";
            return "`$display_name <$php_net>`_";
        } catch (ReflectionException $e) {
            return false;
        }
    }

    public static function createUserProvidedLink(ReflectionNamedType $reflectionNamedType): string|bool {
        // link to web location / file location based on user provided mapping of FQN => url
        $fqn = $reflectionNamedType->getName();
        $parts = explode("\\", $fqn);
        $display_name = end($parts);
        if (array_key_exists($fqn, RunConfiguration::getUserProvidedLinks())) {
            $location = RunConfiguration::getUserProvidedLinks()[$fqn];
            return "`$display_name <$location>`_";
        }
        // link to web location / file location based on user provided mapping of FQN-part => base_url
        foreach (RunConfiguration::getUserProvidedLinks() as $key => $base_url) {
            if (str_starts_with($fqn, $key)) {
                $base_url = str_ends_with($base_url, "/") ? $base_url : $base_url . "/";
                $end_url = str_replace("\\", "/", $fqn) . ".php";
                $location = $base_url . $end_url;
                return "`$display_name <$location>`_";
            }
        }
        return false;
    }

    public static function createSourceLink(ReflectionNamedType $reflectionNamedType): string|bool {
        if (!RunConfiguration::getLinkToSources()) return false;
        $fqn = $reflectionNamedType->getName();
        try {
            $class = new ReflectionClass($fqn);
            $filename = $class->getFileName();
            if ($filename) {
                $parts = explode("\\", $fqn);
                $display_name = end($parts);
                $location = "file://" . $filename;
                return "`$display_name <$location>`_";
            }
        } catch (ReflectionException) {
            return false;
        }
        return false;
    }

    public static function createSearchEngineLink(ReflectionNamedType $reflectionNamedType): string|bool {
        if (!RunConfiguration::getLinkToSearchEngine()) return false;
        $fqn = $reflectionNamedType->getName();
        $parts = explode("\\", $fqn);
        $display_name = end($parts);
        $location = self::SEARCH_ENGINE . $fqn;
        return "`$display_name <$location>`_";
    }

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

        $result = self::findInParameters($uri); // inline link can point to params
        if ($result) return $result;

        $name = $uri;
        $method = "";
        $del = strpos($uri, "::");
        if ($del) {
            $name = substr($uri, 0, $del);
            $method = substr($uri, $del);
        }

        $name = self::findFQCN($name);

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

    public static function findInParameters(string $type): string|bool {
        if (!str_starts_with($type, "$")) return false;
        $method = ProcessState::getCurrentMethod();
        if (!is_null($method)) {
            $search = substr($type, 1);
            foreach ($method->getParameters() as $parameter) {
                if ($parameter->getName() == $search) {
                    $class = ProcessState::getCurrentClass()->getName();
                    return ":tagsign:`param`:ref:`" . $type . "<" . $class . "::" . $method->getName() . "()>`";
                }
            }
        }
        return false;
    }

    public static function findFQCN(string $type): string {
        if (str_contains($type, "\\")) return $type;
        if (is_null(ProcessState::getCurrentClass())) return $type;
        $file = ProcessState::getCurrentClass()->getFileName();
        $string = file_get_contents($file);
        $lines = explode(PHP_EOL, $string);
        foreach ($lines as $line) {
            if (str_contains($line, "use") and str_contains($line, $type)) {
                $start = strpos($line, " ") + 1;
                $semicolon = strpos($line, ";");
                return substr($line, $start, ($semicolon - $start));
            }
        }
        return $type;
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
        if (in_array(strtolower($name), self::$data_types)) return $name;
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
            Log::debug("Not an internal class: [" . $e->getMessage() . "] -> "
                . ProcessState::getCurrentFile());
        }
        return false;
    }

}