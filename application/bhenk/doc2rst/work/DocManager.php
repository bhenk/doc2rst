<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\conf\Config;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\model\ClassHeadReaderInterface;
use bhenk\doc2rst\model\DocManagerInterface;
use ReflectionClass;
use function file_put_contents;
use function is_null;
use function str_replace;
use function strlen;
use function substr;

class DocManager implements DocManagerInterface {

    private array $scannedDocuments = [];

    private ReflectionClass $currentClass;

    public function work(): void {
        $source_dir = Config::get()->getValue("source_directory");
        Log::notice("Starting doc2rst in source directory " . $source_dir);
        (new DirectoryCrawler())->makeDocumentTree();
        Log::notice("Build success. "
            . Log::getErrorCount() . " errors, "
            . Log::getWarningsCount() . " warnings"
        );
    }

    public function makeDocument(string $classname, string $path, string $workdir): void {
        $application_root = Config::get()->getValue("application_root");
        $input_prefix = strlen($application_root) + 1;
        $rst_filename = $workdir . DIRECTORY_SEPARATOR . $classname . ".rst";
        $namespace = str_replace("/", "\\", substr($path, $input_prefix));
        $fq_classname = $namespace . "\\" . $classname;
        $rc = new ReflectionClass($fq_classname);
        $this->setCurrentClass($rc);

        // head
        $classHeadReader = $this->getClassHeadReader();
        $s = $classHeadReader->render($rc);

        // class docs
        $docCommentReader = new DocCommentEditor();
        $s .= $docCommentReader->readDoc($rc->getDocComment());

        //$s .= PHP_EOL . ".. contents::" . PHP_EOL;

        $constantsReader = new ConstantsReader();
        $s .= $constantsReader->render($rc);

        file_put_contents($rst_filename, $s);
        Log::debug("created file     : " . $rst_filename);
    }

    public function getClassHeadReader(): ClassHeadReaderInterface {
        $phpClassReader = Config::get()->getValue("php_class_reader");
        if (is_null($phpClassReader)) {
            $phpClassReader = new ClassHeadReader();
        }
        return $phpClassReader;
    }

    public function setScannedDocuments(array $scanned): void {
        $this->scannedDocuments = $scanned;
    }

    /**
     * @return array
     */
    public function getScannedDocuments(): array {
        return $this->scannedDocuments;
    }

    /**
     * @return ReflectionClass
     */
    public function getCurrentClass(): ReflectionClass {
        return $this->currentClass;
    }

    /**
     * @param ReflectionClass $currentClass
     */
    public function setCurrentClass(ReflectionClass $currentClass): void {
        $this->currentClass = $currentClass;
    }


}