<?php

namespace bhenk\doc2rst\globals;

use ReflectionClass;
use ReflectionMethod;
use UnitEnum;

class ProcessState extends AbstractStaticContainer {

    private static ?ReflectionClass $current_class = null;
    private static ?ReflectionMethod $current_method = null;

    public static function enumForName(string $id): ?UnitEnum {
        return Process::forName($id);
    }

    /**
     * @return ReflectionClass|null
     */
    public static function getCurrentClass(): ?ReflectionClass {
        return self::$current_class;
    }

    /**
     * @param ReflectionClass|null $current_class
     */
    public static function setCurrentClass(?ReflectionClass $current_class): void {
        self::$current_class = $current_class;
    }

    /**
     * @return ReflectionMethod|null
     */
    public static function getCurrentMethod(): ?ReflectionMethod {
        return self::$current_method;
    }

    /**
     * @param ReflectionMethod|null $current_method
     */
    public static function setCurrentMethod(?ReflectionMethod $current_method): void {
        self::$current_method = $current_method;
    }

}