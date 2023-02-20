<?php

namespace bhenk\doc2rst\globals;

use Psr\Container\ContainerInterface;
use TypeError;
use UnitEnum;
use function call_user_func;
use function explode;
use function is_null;
use function ucfirst;

abstract class AbstractContainer implements ContainerInterface {

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