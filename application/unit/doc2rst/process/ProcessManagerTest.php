<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\process\ProcessManager;
use PHPUnit\Framework\TestCase;
use function dirname;
use function is_dir;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class ProcessManagerTest extends TestCase {


    public function testScan() {
        $configuration = [
            "application_root" => dirname(__DIR__, 3),
        ];
        $doc_root = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . "docs";
        $pm = new ProcessManager($doc_root);
        assertEquals("x", "x");
        $pm->testRun();
    }

    public function testStart() {
        $configuration = [
            "application_root" => dirname(__DIR__, 3),
        ];
        $doc_root = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . "docs";
        $pm = new ProcessManager($doc_root);
        assertEquals("x", "x");
        $pm->run();
    }
}
