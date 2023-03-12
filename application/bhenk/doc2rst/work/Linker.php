<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\globals\ProcessState;
use function array_diff;
use function str_contains;
use function dirname;
use function explode;
use function file_get_contents;
use function implode;
use function in_array;
use function is_null;
use function scandir;
use function str_replace;
use function str_starts_with;
use function strpos;
use function strtolower;
use function substr;

class Linker {

    public static function getLink(?string $search, ?string $description = null): string {
        if (is_null($search)) return "";

        if (str_starts_with($search, "?")) {
            $result = self::tryCreateLink(substr($search, 1), $description);
            return "?\ " . $result;
        }
        $result = [];
        foreach (explode("|", $search) as $uri_type) {
            $result[] = self::tryCreateLink($uri_type, $description);
        }
        return implode(" | ", $result);
    }

    public static function tryCreateLink(string $uri_type, ?string $description = null): string {
        // datatype
        if (in_array(strtolower($uri_type), TypeLinker::$data_types)) return $uri_type;

        // normal link
        $result = self::createLink($uri_type, $description);
        if ($result) return $result;

        // parameters of current method
        $result = self::findInParameters($uri_type);
        if ($result) return $result;

        // type link {file link} {search engine link}
        return self::createTypeLink($uri_type, $description);
    }

    public static function createLink(string $uri, ?string $desc): string|bool {
        $protocols = ["http://", "https://", "file://", "ftp://", "ftps://,", "gopher://", "mailto:"];
        foreach ($protocols as $protocol) {
            if (str_starts_with($uri, $protocol)) {
                if (empty($desc)) return $uri;
                // `Link text <https://domain.invalid/>`_
                return "`$desc <$uri>`_";
            }
        }
        return false;
    }

    public static function findInParameters(string $type): string|bool {
        if (!str_starts_with($type, "$")) return false;
        $method = ProcessState::getCurrentMethod();
        if (!is_null($method)) {
            $search = substr($type, 1);
            foreach ($method->getParameters() as $parameter) {
                if ($parameter and $parameter->getName() == $search) {
                    $class = ProcessState::getCurrentClass()->getName();
                    //return ":tagsign:`param`:ref:`" . $type . "<" . $class . "::" . $method->getName() . ">`";
                    return ":tagsign:`param` :tech:`" . $type . "`";
                }
            }
        }
        return false;
    }

    public static function createTypeLink(string $type, string $description = null): string {
        $sep = strpos($type, "::");
        $name = $sep ? substr($type, 0, $sep) : $type;
        $member = $sep ? substr($type, $sep + 2) : null;
        $fqcn = self::findFQCN($name);
        return TypeLinker::resolveFQCN($fqcn, $member, $description);
    }

    public static function findFQCN(string $type): string {
        if (str_contains($type, "\\")) return $type;
        $currentClass = ProcessState::getCurrentClass();
        if (is_null($currentClass)) return $type;
        if ($currentClass->getShortName() == $type) return $currentClass->getName();

        // package classes
        $file = $currentClass->getFileName();
        $package = dirname($file);
        $files = array_diff(scandir($package, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        foreach ($files as $filename) {
            if ($type == substr($filename, 0, -4)) {
                return str_replace("/", "\\",
                    $currentClass->getNamespaceName() . "/" . substr($filename, 0, -4));
            }
        }

        // use statements
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

}