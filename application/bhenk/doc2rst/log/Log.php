<?php

namespace bhenk\doc2rst\log;

use bhenk\doc2rst\globals\RunConfiguration;
use Throwable;
use function debug_backtrace;
use function fwrite;
use function is_null;

class Log {

    private static int $errorCount = 0;
    private static int $warningsCount = 0;
    private static bool $enabled = true;

    public static function setEnabled(bool $enabled): void {
        self::$enabled = $enabled;
    }

    public static function error(string $err, Throwable $e = null, bool $back_trace = true): void {
        if (self::$enabled) {
            $trace = $back_trace ? self::backTrace() : "";
            fwrite(STDERR, "\033[1m\033[48;5;15m\033[38;5;9m"
                . "Error  :"
                . "\033[1m\033[0m\033[38;5;9m "
                . $err
                . $trace
                . PHP_EOL);
            while (!is_null($e)) {
                fwrite(STDERR, "\t Caused by: " . $e::class . PHP_EOL);
                fwrite(STDERR, "\t Message  : " . $e->getMessage() . PHP_EOL);
                fwrite(STDERR, "\t File     : file://" . $e->getFile() . ":" . $e->getLine() . PHP_EOL);
                $e = $e->getPrevious();
            }
            fwrite(STDERR, "\033[0m " . PHP_EOL);
        }
        self::$errorCount++;
    }

    public static function warning(string $warning, bool $back_trace = true): void {
        if (self::getLevel() <= 400 and self::$enabled) {
            $trace = $back_trace ? self::backTrace() : "";
            fwrite(STDOUT, "\033[1m\033[48;5;15m\033[38;5;56m"
                . "Warning:"
                . "\033[0m "
                . $warning
                . $trace
                . PHP_EOL);
        }
        self::$warningsCount++;
    }

    public static function notice(string $out, bool $back_trace = true): void {
        if (self::getLevel() <= 300 and self::$enabled) {
            $trace = $back_trace ? self::backTrace() : "";
            fwrite(STDOUT, "\033[1m\033[48;5;249m\033[38;5;21m"
                . "Notice:"
                . "\033[0m "
                . $out
                . $trace
                . PHP_EOL);
        }
    }

    public static function info(string $out, bool $back_trace = true): void {
        if (self::getLevel() <= 200 and self::$enabled) {
            $trace = $back_trace ? self::backTrace() : "";
            fwrite(STDOUT, "\033[1m\033[48;5;251m\033[38;5;28m"
                . "Info:  "
                . "\033[0m "
                . $out
                . $trace
                . PHP_EOL);
        }
    }

    public static function debug(string $out, bool $back_trace = true): void {
        if (self::getLevel() <= 100 and self::$enabled) {
            $trace = $back_trace ? self::backTrace() : "";
            fwrite(STDOUT, "\033[1m\033[48;5;255m\033[38;5;100m"
                . "Debug: "
                . "\033[0m "
                . $out
                . $trace
                . PHP_EOL);
        }
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
        return RunConfiguration::getLogLevel();
    }

    private static function backTrace(): string {
        $trace = debug_backtrace(0, 3);
        return PHP_EOL . "        "
            . "<="
            . " file://" . $trace[1]["file"] . ":" . $trace[1]["line"];
    }

}