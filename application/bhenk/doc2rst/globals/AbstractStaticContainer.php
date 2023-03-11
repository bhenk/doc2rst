<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\globals;

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

/**
 * Base class for static container classes that load their values from an Array.
 *
 * Implementations of this abstract static container use a {@link UnitEnum} to correlate their properties
 * to keys in the array in a way that
 * ```
 * property name == enum->name == key
 * method name == [get|set] + camelcase(property name)
 * ```
 * @inheritDoc
 */
abstract class AbstractStaticContainer implements ContainerInterface, Stringable {

    /**
     * Returns the enum case for the given {@link $id} or *null* if it does not exist.
     *
     * @param string $id enum name
     * @return UnitEnum|null enum case with the given {@link $id} or *null*
     */
    public static abstract function enumForName(string $id): ?UnitEnum;

    /**
     * @inheritDoc
     */
    public function get(string $id): mixed {
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

    /**
     * Returns a string representation of this container.
     *
     * @return string
     */
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
     * @param array $configuration
     * @return void
     * @throws ContainerException if array in {@link $configuration} not correct
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

    /**
     * Returns an array representing the container.
     *
     * @return array array representing the container
     */
    public static function toArray(): array {
        $rc = new ReflectionClass(static::class);
        $arr = [];
        foreach ($rc->getProperties() as $prop) {
            $arr[$prop->getName()] = $prop->getValue($rc);
        }
        return $arr;
    }

    /**
     * Reset the container to a neutral state (not necessarily to its original state).
     *
     * @return array representing the neutral state
     * @throws ContainerException
     */
    public static function reset(): array {
        $rc = new ReflectionClass(static::class);
        $configuration = [];
        foreach ($rc->getProperties() as $prop) {
            $val = null;
            $type = $prop->getType();
            $name = $prop->getName();
            if ($type == "int") $val = 0;
            if ($type == "array") $val = [];
            if ($type == "bool") $val = false;
            $configuration[$name] = $val;
        }
        self::load($configuration);
        return $configuration;
    }

    /**
     * Return the method name part corresponding to the given {@link $id}
     *
     * Input of snake_like_name, output CamelCaseName:
     * ```
     * foo_bar_name -> FooBarName
     * ```
     *
     * @param string $id snake_like_name
     * @return string CamelCaseName
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