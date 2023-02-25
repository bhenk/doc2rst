<?php

namespace bhenk\doc2rst\globals;

use bhenk\doc2rst\process\CommentLexer;
use bhenk\doc2rst\tag\LinkTag;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use Stringable;
use TypeError;
use UnitEnum;
use function call_user_func;
use function explode;
use function is_array;
use function is_bool;
use function is_null;
use function max;
use function str_repeat;
use function strlen;
use function ucfirst;

abstract class AbstractStaticContainer implements ContainerInterface, Stringable {

    public static abstract function enumForName(string $id): ?UnitEnum;

    /**
     * @inheritDoc
     */
    public function get(string $id) {
        $enum = static::enumForName($id);
        if (is_null($enum)) {
            throw new NotFoundException("Id not found: " . $id, 404);
        }
        $name = self::getMethodName($id);
        return call_user_func(static::class . '::get' . $name);
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool {
        return !is_null(static::enumforName($id));
    }

    public function __toString(): string {
        $rc = new ReflectionClass(static::class);
        $max_length = 0;
        $s = "";
        foreach ($rc->getProperties() as $prop) {
            $max_length = max(strlen($prop->getName()), $max_length);
        }
        foreach ($rc->getProperties() as $prop) {
            $name = $prop->getName();
            $quotation = $prop->getType()->getName() == "string" ? '"' : "";
            $val = $prop->getValue($rc);
            if (is_null($val)) {
                $quotation = "";
                $val = "null";
            }
            if (is_bool($val)) $val = $val ? "true" : "false";
            if ($prop->getType()->getName() == "array") {
                $v = "[" . PHP_EOL;
                foreach ($val as $key => $value) {
                    if (is_array($value)) $value = "{array}";
                    $v .= str_repeat(" ", $max_length)
                        . "        [$key] => $value" . PHP_EOL;
                }
                $v .= str_repeat(" ", $max_length) . "      ]";
                $val = $v;
            }
            $s .= '"' . $prop->getName() . '"'
                . str_repeat(" ", $max_length - strlen($name))
                . " => "
                . $quotation . $val . $quotation
                . PHP_EOL;
        }
        return $s;
    }

    /**
     * Load the container with the given configuration.
     *
     * Keys in the array *configuration* should correspond to the names of cases in the {@link UnitEnum} given by
     * {@link AbstractStaticContainer::enumForName()}.
     *
     * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md
     * @see LinkTag
     * @see CommentLexer::getDocComment()
     * @see ReflectionClass
     *
     * @param array $configuration
     * @return void
     * @throws ContainerException if configuration not correct
     */
    public static function load(array $configuration): void {
        foreach ($configuration as $key => $val) {
            $enum = static::enumForName($key);
            if (is_null($enum)) {
                throw new ContainerException("Unknown key: " . $key, 100);
            }
            $name = self::getMethodName($key);
            try {
                call_user_func(static::class . '::set' . $name, $val);
            } catch (TypeError $e) {
                throw new ContainerException("Wrong type for " . $key, 200, $e);
            }
        }
    }

    public static function toArray(): array {
        $rc = new ReflectionClass(static::class);
        $arr = [];
        foreach ($rc->getProperties() as $prop) {
            $arr[$prop->getName()] = $prop->getValue($rc);
        }
        return $arr;
    }

    /**
     * @param string $id
     * @return string
     */
    public static function getMethodName(string $id): string {
        $parts = explode("_", $id);
        $name = "";
        foreach ($parts as $part) {
            $name .= ucfirst($part);
        }
        return $name;
    }
}