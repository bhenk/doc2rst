<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\process\ProcessManager;
use PHPUnit\Framework\TestCase;
use function dirname;
use function is_dir;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class ProcessManagerTest extends TestCase {

    public function testAutoFindApplicationRoot() {
        $doc_root = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . "docs";
        assertTrue(is_dir($doc_root));

        $application_root = ProcessManager::autoFindApplicationRoot($doc_root);
        $expected = dirname($doc_root) . DIRECTORY_SEPARATOR . "application";
        assertEquals($expected, $application_root);
    }

    public function testAutoFindSource() {
        $application_root = dirname(__DIR__, 3);
        $source_directory = ProcessManager::autoFindSource($application_root);
        $expected = $application_root . DIRECTORY_SEPARATOR . "bhenk";
        assertEquals($expected, $source_directory);
    }
}
