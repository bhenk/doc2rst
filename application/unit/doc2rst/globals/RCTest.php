<?php

namespace unit\doc2rst\globals;

use bhenk\doc2rst\globals\RC;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

class RCTest extends TestCase {

    public function testRCNames() {
//        foreach (RC::cases() as $case) {
//            echo "private static string $" . $case->name . ";" . PHP_EOL;
//        }
        $rc = RC::forName("source_directory");
        assertEquals(RC::source_directory, $rc);

        $rc = RC::forName("not an RC");
        assertNull($rc);
    }

}
