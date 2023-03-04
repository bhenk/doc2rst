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
use function implode;
use function in_array;
use function str_replace;
use function strtolower;

class TypeLinker {

    const PHP_CLASS_NET = "https://www.php.net/manual/en/class";
    const SEARCH_ENGINE = "https://www.google.com/search?q=";

    public static function resolveReflectionType(ReflectionType $reflectionType): string {
        $name = "unknown";
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
            return $name;
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

}