<?php

namespace unit\doc2rst\globals;

use bhenk\doc2rst\globals\PS;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class PSTest extends TestCase {

    public function testPsNames() {
//        foreach (PS::cases() as $case) {
//            echo "private static array $" . $case->name . ";" . PHP_EOL;
//        }

        $ps = PS::forName(PS::scanned_php_files->name);
        assertEquals(PS::scanned_php_files, $ps);
    }

}
