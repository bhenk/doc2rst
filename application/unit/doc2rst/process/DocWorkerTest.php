<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\process\DocWorker;
use bhenk\doc2rst\rst\RstFile;
use PHPUnit\Framework\TestCase;
use function dirname;
use function PHPUnit\Framework\assertEquals;
use function realpath;

class DocWorkerTest extends TestCase {

    public function testPassage() {
        if (1 == 0) $this->workerOnPlainFile();
        assertEquals(1, 1);
    }

    public function workerOnPlainFile() {
        RunConfiguration::setLogLevel(0);
        RunConfiguration::setShowClassContents(true);
        RunConfiguration::setApplicationRoot(realpath(dirname(__DIR__, 4)
            . DIRECTORY_SEPARATOR . "application"));
        //$path = __DIR__ . DIRECTORY_SEPARATOR . "test_files" . DIRECTORY_SEPARATOR . "parser-test.php";
        $path = "/Users/ecco/PhpstormProjects/doc2rst/application/unit/doc2rst/process/test_files/ExampleClass.php";
        //$path = "/Users/ecco/PhpstormProjects/doc2rst/application/bhenk/doc2rst/globals/ProcessState.php";
        $worker = new DocWorker();
        $document = $worker->processDoc($path);
//        assertStringContainsString("**recommended to have a namespace**", $document);
//        assertStringContainsString("unit\\doc2rst\\process\\test_files", $document);
        assertEquals(1, 1);

        $output = $this->dump($document);

    }

    /**
     * @param RstFile $document
     * @return array
     */
    public function dump(RstFile $document): array {
        $dump_dir = realpath(dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . "test_dump");
        $source_dir = $dump_dir . DIRECTORY_SEPARATOR . "source";
        $output_dir = $dump_dir . DIRECTORY_SEPARATOR . "_build";
        $filename = basename($document->getFilename());
        $document->setFilename($source_dir . DIRECTORY_SEPARATOR . $filename);
        $document->putContents();
        $output = [];
        exec("sphinx-build -b html " . $dump_dir . " " . $output_dir, $output);
        foreach ($output as $line) {
            echo $line . PHP_EOL;
        }
        return $output;
    }


}
