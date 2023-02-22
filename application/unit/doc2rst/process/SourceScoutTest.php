<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\process\SourceScout;
use PHPUnit\Framework\TestCase;
use function dirname;
use function PHPUnit\Framework\assertContains;
use function str_replace;

class SourceScoutTest extends TestCase {

    public function testScanSource() {
        $application_root = dirname(__DIR__, 3);
        $source_directory = $application_root . DIRECTORY_SEPARATOR . "bhenk";
        RunConfiguration::setApplicationRoot($application_root);
        RunConfiguration::setSourceDirectory($source_directory);

        $dw = new SourceScout();
        $dw->scanSource();
        $rel_path = str_replace("\\", "/", SourceScout::class) . ".php";
        assertContains($rel_path, SourceState::getPhpFiles());
    }

}
