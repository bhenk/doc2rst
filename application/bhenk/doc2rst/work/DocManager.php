<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\conf\Config;
use bhenk\doc2rst\log\Log;
use ReflectionClass;
use function file_put_contents;
use function get_class;
use function is_null;
use function str_replace;
use function strlen;
use function substr;

class DocManager {

    private array $scanned = [];

    public function setScannedDocuments(array $scanned) {
        $this->scanned = $scanned;
    }

    public function getPhpClassReader() : PhpClassReaderInterface {
        $phpClassReader = Config::get()->getValue("php_class_reader");
        if (is_null($phpClassReader)) {
            $phpClassReader = new DefaultPhpClassReader();
        }
        return $phpClassReader;
    }

    public function work(): void {
        $source_dir = Config::get()->getValue("source_directory");
        Log::notice("Starting doc2rst in source directory " . $source_dir);
        (new DirectoryCrawler($this))->makeDocumentTree();
    }

    public function makeDocument(string $classname, string $path, string $workdir): void {
        $application_root = Config::get()->getValue("application_root");
        $input_prefix = strlen($application_root) + 1;
        $rst_filename = $workdir . DIRECTORY_SEPARATOR . $classname . ".rst";
        $namespace = str_replace("/", "\\", substr($path, $input_prefix));
        $fq_classname = $namespace . "\\" . $classname;
        $rc = new ReflectionClass($fq_classname);

        // head
        $phpClassReader = $this->getPhpClassReader();
        $s = $phpClassReader->makeClassHead($rc);

        file_put_contents($rst_filename, $s);
        Log::debug("created file     : " . $rst_filename);
    }

}