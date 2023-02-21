<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\globals\FileTypes;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\process\DirectoryWalker;
use PHPUnit\Framework\TestCase;
use function dirname;
use function PHPUnit\Framework\assertContains;
use function str_replace;

class DirectoryWalkerTest extends TestCase {

    public function testScanSource() {
        $application_root = dirname(__DIR__, 3);
        $source_directory = $application_root . DIRECTORY_SEPARATOR . "bhenk";
        $api_directory = dirname($application_root) . DIRECTORY_SEPARATOR . "docs" . DIRECTORY_SEPARATOR . "api";
        RunConfiguration::setApplicationRoot($application_root);
        RunConfiguration::setSourceDirectory($source_directory);
        RunConfiguration::setApiDirectory($api_directory);

        $dw = new DirectoryWalker();
        $dw->scanSource();
        $rel_path = str_replace("\\", "/", DirectoryWalker::class) . ".php";
        assertContains($rel_path, SourceState::getPhpFiles());

        $count = $dw->makeDirectories();
    }

    public function testMakeTocFiles() {
        $application_root = dirname(__DIR__, 3);
        RunConfiguration::setApplicationRoot($application_root);
        $dw = new DirectoryWalker();
        $dw->makeTocFiles(FileTypes::RST | FileTypes::MD);

        self::assertEquals(1, 1);
    }
}
