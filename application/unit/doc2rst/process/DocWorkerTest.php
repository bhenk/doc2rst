<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\process\DocWorker;
use bhenk\doc2rst\rst\RstFile;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use function dirname;
use function PHPUnit\Framework\assertStringContainsString;
use function realpath;

class DocWorkerTest extends TestCase {

    /**
     * documentation on require statement
     */
    public function testOneLine() {
        $ze = new ReflectionClass($this);
        echo $ze->getNamespaceName();

        self::assertEquals(1, 1);
    }

    public function testWorkerOnPlainFile() {
        RunConfiguration::setLogLevel(0);
        RunConfiguration::getShowClassContents(true);
        RunConfiguration::setApplicationRoot(realpath(dirname(__DIR__, 4)
            . DIRECTORY_SEPARATOR . "application"));
        $path = __DIR__ . DIRECTORY_SEPARATOR . "test_files" . DIRECTORY_SEPARATOR . "parser-test.php";
        $worker = new DocWorker();
        $document = $worker->processDoc($path);
        assertStringContainsString("**recommended to have a namespace**", $document);
        assertStringContainsString("unit\\doc2rst\\process\\test_files", $document);


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
        $document->setDirectory($source_dir);
        $document->putContents();
        $output = [];
        exec("sphinx-build -b html " . $dump_dir . " " . $output_dir, $output);
        foreach ($output as $line) {
            echo $line . PHP_EOL;
        }
        return $output;
    }


}
