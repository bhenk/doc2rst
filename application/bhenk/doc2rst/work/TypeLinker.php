<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\log\Log;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionType;
use ReflectionUnionType;
use function addslashes;
use function array_key_exists;
use function end;
use function explode;
use function implode;
use function in_array;
use function is_null;
use function is_string;
use function str_contains;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strtolower;
use function strtoupper;
use function substr;

/**
 * Create links and references to types.
 */
class TypeLinker {

    const PHP_CLASS_NET = "https://www.php.net/manual/en/class";
    const PHP_METHOD_NET = "https://www.php.net/manual/en";
    const SEARCH_ENGINE = "https://www.google.com/search?q=";

    public static array $data_types = [
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

    /**
     * Resolve ReflectionTypes to their representation as reStructuredText links and references
     *
     * This method handles {@link ReflectionNamedType} and {@link ReflectionUnionType}.
     *
     *
     * @param ReflectionType $reflectionType
     * @return string reStructuredText links and references
     */
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
            return self::tryCreateLink($reflectionType, null, $allowsNull);

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

    /**
     * Resolve multiple types to their representation as reStructuredText links and references.
     *
     * The array {@link $types} can consist of strings (fully qualified), {@link ReflectionClass},
     * {@link ReflectionMethod} and {@link ReflectionClassConstant}.
     *
     * @param array $types types to resolve
     * @return array reStructuredText links and references
     */
    public static function resolveMultipleFQCN(array $types): array {
        $result = [];
        /** @var ReflectionClass|string $type */
        foreach ($types as $type) {
            $result[] = self::resolveFQCN($type);
        }
        return $result;
    }

    /**
     * Resolve a type to its representation as reStructuredText link or reference.
     *
     * Strings given as {@link $namedType} can still contain *allows null* (?) and the *or* (string|int)
     * symbol. Strings should be fully qualified (i.e. namespace\\class)
     *
     * @param ReflectionClass|string $namedType Class-like
     * @param ReflectionMethod|ReflectionClassConstant|string|null $member method or constant
     * @param string|null $description description, visible part of link
     * @return string reStructuredText link or reference
     */
    public static function resolveFQCN(
        ReflectionClass|string                          $namedType,
        ReflectionMethod|ReflectionClassConstant|string $member = null,
        string                                          $description = null
    ): string {
        $allowsNull = "";
        if (is_string($namedType)) {
            $allowsNull = str_starts_with($namedType, "?") ? "?\ " : "";
            $namedType = str_replace("?", "", $namedType);
            if (in_array($namedType, self::$data_types)) {
                return $allowsNull . $namedType;
            }
            if (str_contains($namedType, "|")) {
                $results = [];
                foreach (explode("|", $namedType) as $fqcn) {
                    $results[] = self::resolveFQCN($fqcn);
                }
                return implode(" | ", $results);
            }
        }
        return self::tryCreateLink($namedType, $member, $allowsNull, $description);
    }

    private static function tryCreateLink(
        ReflectionNamedType|ReflectionClass|string      $namedType,
        ReflectionMethod|ReflectionClassConstant|string $member = null,
        string                                          $allowsNull = "",
        string                                          $description = null
    ): string|bool {
        $result = self::createDocumentedClassReference($namedType, $member, $description);
        if ($result) return $allowsNull . $result;

        $result = self::createInternalClassLink($namedType, $member);
        if ($result) return $allowsNull . $result;

        $result = self::createUserProvidedLink($namedType, $member);
        if ($result) return $allowsNull . $result;

        $result = self::createSourceLink($namedType, $member);
        if ($result) return $allowsNull . $result;

        $result = self::createSearchEngineLink($namedType, $member);
        if ($result) return $allowsNull . $result;

        $fqcn = is_string($namedType) ? $namedType : $namedType->getName();
        $mena = is_string($member) ? $member : $member?->getName();
        $separator = $mena ? "::" : "";
        $description = $description ? " " . $description : "";
        return $allowsNull . addslashes($fqcn) . $separator . $mena . $description;
    }

    /**
     * Try to establish a reference to a type that's being documented.
     *
     * @param ReflectionNamedType|ReflectionClass|string $namedType
     * @param ReflectionMethod|ReflectionClassConstant|string|null $member
     * @param string|null $description
     * @return string|bool *false* if it does not succeed, reference otherwise
     */
    public static function createDocumentedClassReference(
        ReflectionNamedType|ReflectionClass|string      $namedType,
        ReflectionMethod|ReflectionClassConstant|string $member = null,
        string                                          $description = null
    ): string|bool {
        $fqcn = is_string($namedType) ? $namedType : $namedType->getName();
        $mena = is_string($member) ? $member : $member?->getName();
        if ($mena and str_ends_with($mena, "()")) $mena = substr($mena, 0, -2);
        $rel_filename = str_replace("\\", DIRECTORY_SEPARATOR, $fqcn) . ".php";
        if (str_starts_with($rel_filename, "/")) $rel_filename = substr($rel_filename, 1);
        if (in_array($rel_filename, SourceState::getPhpFiles())) {
            $description = $description ? $description . " " : "";
            $separator = $mena ? "::" : "";
            if (!empty($description)) {
                return ":ref:`$description<$fqcn$separator$mena>`";
            } else {
                return ":ref:`$fqcn$separator$mena`";
            }
        }
        return false;
    }

    /**
     * Try to establish a link to a PHP-type
     *
     * @param ReflectionNamedType|ReflectionClass|string $namedType
     * @param ReflectionMethod|ReflectionClassConstant|string|null $member
     * @return string|bool *false* if it does not succeed, link otherwise
     */
    public static function createInternalClassLink(
        ReflectionNamedType|ReflectionClass|string      $namedType,
        ReflectionMethod|ReflectionClassConstant|string $member = null
    ): string|bool {
        $fqcn = is_string($namedType) ? $namedType : $namedType->getName();
        $mena = is_string($member) ? $member : $member?->getName();
        if ($mena and str_ends_with($mena, "()")) $mena = substr($mena, 0, -2);
        try {
            $class = new ReflectionClass($fqcn);
            if (!$class->isInternal()) return false;
            $separator = $mena ? "::" : "";
            $link_name = strtolower($fqcn);
            $parts = explode("\\", $fqcn);
            $display_name = end($parts) . $separator . $mena;
            if (is_null($mena) or $member instanceof ReflectionClassConstant or strtoupper($member) == $member) {
                // constants on same page...
                $php_net = self::PHP_CLASS_NET . ".$link_name.php";
            } else {
                // methods on different page...
                $link_mena = strtolower($mena);
                $php_net = self::PHP_METHOD_NET . "/$link_name.$link_mena" . ".php";
            }
            return "`$display_name <$php_net>`_";
        } catch (ReflectionException) {
            return false;
        }
    }

    /**
     * Try to establish a link, based on a user provided mapping
     *
     * @see bhenk\doc2rst\globals\RC::user_provided_links
     *
     * @param ReflectionNamedType|ReflectionClass|string $namedType
     * @param ReflectionMethod|ReflectionClassConstant|string|null $member
     * @return string|bool *false* if it does not succeed, link otherwise
     */
    public static function createUserProvidedLink(
        ReflectionNamedType|ReflectionClass|string      $namedType,
        ReflectionMethod|ReflectionClassConstant|string $member = null
    ): string|bool {
        // link to web location/file location based on user provided mapping of FQCN[::member] => url
        $fqcn = is_string($namedType) ? $namedType : $namedType->getName();
        $mena = is_string($member) ? $member : $member?->getName();
        $parts = explode("\\", $fqcn);
        if (array_key_exists("$fqcn::$mena", RunConfiguration::getUserProvidedLinks())) {
            $location = RunConfiguration::getUserProvidedLinks()["$fqcn::$mena"];
            $display_name = end($parts) . "::$mena";
            return "`$display_name <$location>`_";
        }
        if (array_key_exists($fqcn, RunConfiguration::getUserProvidedLinks())) {
            $location = RunConfiguration::getUserProvidedLinks()[$fqcn];
            $display_name = end($parts);
            return "`$display_name <$location>`_";
        }
        // link to web location/file location based on user provided mapping of FQN-part => base_url
        foreach (RunConfiguration::getUserProvidedLinks() as $key => $url) {
            if (str_starts_with($fqcn, $key)) {
                $location = $url;
                $separator = $mena ? "::" : "";
                $display_name = end($parts) . $separator . $mena;
                return "`$display_name <$location>`_";
            }
        }
        return false;
    }

    /**
     * Try to establish a *file://* type link to a source-file
     *
     * @see bhenk\doc2rst\globals\RC::link_to_sources
     *
     * @param ReflectionNamedType|ReflectionClass|string $namedType
     * @param ReflectionMethod|ReflectionClassConstant|string|null $member
     * @return string|bool *false* if it does not succeed, link otherwise
     */
    public static function createSourceLink(
        ReflectionNamedType|ReflectionClass|string      $namedType,
        ReflectionMethod|ReflectionClassConstant|string $member = null
    ): string|bool {
        if (!RunConfiguration::getLinkToSources()) return false;
        $fqcn = is_string($namedType) ? $namedType : $namedType->getName();
        $mena = is_string($member) ? $member : $member?->getName();
        if ($mena and str_ends_with($mena, "()")) $mena = substr($mena, 0, -2);
        try {
            $class = new ReflectionClass($fqcn);
            $filename = $class->getFileName();
            if ($filename) {
                $line = "";
                if ($mena and $class->hasMethod($mena)) $line = ":" . $class->getMethod($mena)->getStartLine();
                $parts = explode("\\", $fqcn);
                $separator = $mena ? "::" : "";
                $display_name = end($parts) . $separator . $mena;
                $location = "file://" . $filename . $line;
                return "`$display_name <$location>`_";
            }
        } catch (ReflectionException) {
            return false;
        }
        return false;
    }

    /**
     * Try and throw a type at a search engine
     *
     * @see bhenk\doc2rst\globals\RC::link_to_search_engine
     *
     * @param ReflectionNamedType|ReflectionClass|string $namedType
     * @param ReflectionMethod|ReflectionClassConstant|string|null $member
     * @return string|bool *false* if the method is not allowed (according to configuration), link otherwise
     */
    public static function createSearchEngineLink(
        ReflectionNamedType|ReflectionClass|string      $namedType,
        ReflectionMethod|ReflectionClassConstant|string $member = null
    ): string|bool {
        if (!RunConfiguration::getLinkToSearchEngine()) return false;
        $fqcn = is_string($namedType) ? $namedType : $namedType->getName();
        $mena = is_string($member) ? $member : $member?->getName();
        $parts = explode("\\", $fqcn);
        $separator = $mena ? "::" : "";
        $display_name = end($parts) . $separator . $mena;
        $location = self::SEARCH_ENGINE . addslashes($fqcn) . $separator . $mena;
        return "`$display_name <$location>`_";
    }

}