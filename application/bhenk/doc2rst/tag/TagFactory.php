<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\log\Log;
use ReflectionClass;
use ReflectionException;
use function explode;
use function implode;
use function strpos;
use function substr;

class TagFactory {

    public static function resolveTags(string $line): string {
        $parts = self::explodeOnTags($line, []);
        $processed = self::resolveInlineTags($parts);
        return implode("", $processed);
    }

    /**
     * Split a line on inline tags.
     *
     * This is a recursive function. Example:
     *
     * ```rst
     * .. code-block::
     *
     *     before: "Gets the {@link BarClass} out of the {@link Foo::method}"
     *
     *     after : ["Gets the ", "{@link BarClass}", " out of the ", "{@link Foo::method}"]
     * ```
     *
     * @param string $line any string
     * @param array $parts optional - any array
     * @return array with ``$line`` exploded on inline tags
     */
    public static function explodeOnTags(string $line, array $parts = []): array {
        $pos1 = strpos($line, "{@");
        $pos2 = strpos($line, "}");
        if ($pos2) {
            $first = substr($line, 0, $pos1);
            $second = substr($line, $pos1, ($pos2 - $pos1) + 1);
            if (!empty($first)) $parts[] = $first;
            $parts[] = $second;
            $line = substr($line, $pos2 + 1);
            return self::explodeOnTags($line, $parts);
        } else {
            if (!empty($line)) $parts[] = $line;
        }
        return $parts;
    }

    public static function resolveInlineTags(array $parts): array {
        $processed = [];
        foreach ($parts as $part) {
            if (str_starts_with($part, "{@")) {
                if (str_ends_with($part, ".")) $part = substr($part, 0, -1);
                $processed[] = self::getTagClass($part);
            } else {
                $processed[] = $part;
            }
        }
        return $processed;
    }

    public static function getTagClass(string $tag): AbstractTag {
        $tag_name = explode(" ", $tag)[0];
        if (str_starts_with($tag_name, "{")) $tag_name = substr($tag_name, 1);
        if (str_ends_with($tag_name, "}")) $tag_name = substr($tag_name, 0, -1);
        $class_name = __NAMESPACE__ . "\\" . substr($tag_name, 1) . "Tag";
        try {
            $maybeRC = new ReflectionClass($class_name);
            return $maybeRC->newInstance($tag);
        } catch (ReflectionException) {}

        return new class($tag) extends AbstractTag {

            public function getTagName(): string {
                return explode(" ", $this->tag_string)[0];
            }

            public function render(): void {}

            public function __toString(): string {
                return $this->getLine();
            }
        };
    }

}