<?php

namespace unit\doc2rst\globals;

use bhenk\doc2rst\globals\Sources;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class SourcesTest extends TestCase {

    public function testSourcesNames() {
//        foreach (Sources::cases() as $case) {
//            echo "private static array $" . $case->name . " = [];" . PHP_EOL;
//        }

//        foreach (Sources::cases() as $case) {
//            echo "public static function add"
//                . SourceState::getMethodName($case->name) . "(string $" . $case->name . "): void {"
//                . PHP_EOL
//                . "self::$" . $case->name . "[] = " . "$" . $case->name . ";"
//                . PHP_EOL
//                . "}" . PHP_EOL;
//            ;
//
//        }

        $ps = Sources::forName(Sources::php_files->name);
        assertEquals(Sources::php_files, $ps);
    }

}
