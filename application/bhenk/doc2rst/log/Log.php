<?php

namespace bhenk\doc2rst\log;

use bhenk\doc2rst\conf\Config;
use function fwrite;

class Log {

    private static int $errorCount = 0;
    private static int $warningsCount = 0;

    public static function error(string $err): void {
        if (self::getLevel() <= 100) {
            fwrite(STDERR, "\033[1m\033[48;5;15m\033[38;5;124m"
                . "Error  :"
                . "\033[0m "
                . $err
                . PHP_EOL);
        }
        self::$errorCount++;
    }

    public static function warning(string $warning): void {
        if (self::getLevel() <= 400) {
            fwrite(STDOUT, "\033[1m\033[48;5;15m\033[38;5;56m"
                . "Warning:"
                . "\033[0m "
                . $warning
                . PHP_EOL);
        }
        self::$warningsCount++;
    }

    public static function notice(string $out): void {
        if (self::getLevel() <= 300) {
            fwrite(STDOUT, "\033[1m\033[48;5;249m\033[38;5;21m"
                . $out
                . "\033[0m"
                . PHP_EOL);
        }
    }

    public static function info(string $out): void {
        if (self::getLevel() <= 200) {
            fwrite(STDOUT, "\033[1m\033[38;5;21m"
                . $out
                . "\033[0m"
                . PHP_EOL);
        }
    }

    public static function debug(string $out): void {
        if (self::getLevel() <= 100)
            fwrite(STDOUT, $out . PHP_EOL);
    }

    /**
     * @return int
     */
    public static function getErrorCount(): int {
        return self::$errorCount;
    }

    /**
     * @return int
     */
    public static function getWarningsCount(): int {
        return self::$warningsCount;
    }

    private static function getLevel(): int {
        return Config::get()->getValue("log_level") ?? 100;
    }

}