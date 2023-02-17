<?php

namespace bhenk\doc2rst\log;

class Log {

    public static function error(string $err): void {
        fwrite(STDERR, "\033[1m\033[48;5;15m\033[38;5;124m"
            . $err
            . "\033[0m"
            . PHP_EOL);
    }

    public static function notice(string $out): void {
        fwrite(STDOUT, "\033[1m\033[48;5;249m\033[38;5;21m"
            .$out
            . "\033[0m"
            . PHP_EOL);
    }

    public static function debug(string $out): void {
        fwrite(STDOUT, $out . PHP_EOL);
    }

}