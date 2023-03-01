<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\process\ProcessManager;
use PHPUnit\Framework\TestCase;
use function dirname;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function PHPUnit\Framework\assertTrue;
use function unlink;

class ProcessManagerTest extends TestCase {

    private string $doc_root;
    private string $file_conf;
    private string $previous_conf;

    public function setUp(): void {
        Log::setEnabled(false);
        $this->doc_root = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . "docs";
        $this->file_conf = $this->doc_root . DIRECTORY_SEPARATOR . "conf.php";
        if (file_exists($this->file_conf)) {
            $this->previous_conf = file_get_contents($this->file_conf);
        }
        RunConfiguration::reset();
        parent::setUp();
    }

    public function tearDown(): void {
        if (isset($this->previous_conf)) {
            file_put_contents($this->file_conf, $this->previous_conf);
        }
        parent::tearDown();
        Log::setEnabled(true);
    }

    public function testQuickStart() {
        if (file_exists($this->file_conf))
            unlink($this->file_conf);
        assertTrue(!file_exists($this->file_conf));
        $manager = new ProcessManager($this->doc_root);
        $manager->quickStart();
        assertTrue(file_exists($this->file_conf));
    }
}
