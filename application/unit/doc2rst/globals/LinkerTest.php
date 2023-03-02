<?php

namespace unit\doc2rst\globals;

use bhenk\doc2rst\globals\Linker;
use bhenk\doc2rst\globals\ProcessState;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use function PHPUnit\Framework\assertEquals;

class LinkerTest extends TestCase {

    /**
     * @param string $some
     * @param bool $lots
     * @param int $x
     * @return string
     */
    public function getThings(string $some, bool $lots, int $x = 0): string {
        return "";
    }

    public function testFindFQCN() {
        ProcessState::setCurrentClass(new ReflectionClass(self::class));

        $result = Linker::findFQCN("ProcessState");
        assertEquals("bhenk\doc2rst\globals\ProcessState", $result);
    }
}
