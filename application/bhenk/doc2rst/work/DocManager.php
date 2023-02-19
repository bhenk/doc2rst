<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\conf\Config;
use bhenk\doc2rst\conf\DocManagerInterface;
use bhenk\doc2rst\log\Log;
use ReflectionClass;
use ReflectionClassConstant;
use function file_put_contents;
use function is_null;
use function str_replace;
use function strlen;
use function substr;

class DocManager implements DocManagerInterface {

    private array $scanned = [];

    public function setScannedDocuments(array $scanned): void {
        $this->scanned = $scanned;
    }

    public function work(): void {
        $source_dir = Config::get()->getValue("source_directory");
        Log::notice("Starting doc2rst in source directory " . $source_dir);
        (new DirectoryCrawler())->makeDocumentTree();
    }

    public function makeDocument(string $classname, string $path, string $workdir): void {
        $application_root = Config::get()->getValue("application_root");
        $input_prefix = strlen($application_root) + 1;
        $rst_filename = $workdir . DIRECTORY_SEPARATOR . $classname . ".rst";
        $namespace = str_replace("/", "\\", substr($path, $input_prefix));
        $fq_classname = $namespace . "\\" . $classname;
        $rc = new ReflectionClass($fq_classname);

        // head
        $classHeadReader = $this->getClassHeadReader();
        $s = $classHeadReader->makeClassHead($rc);

        // class docs
        $docCommentReader = new DocCommentReader();
        $s .= $docCommentReader->readDoc($rc->getDocComment());

        $consts = $rc->getConstants(ReflectionClassConstant::IS_PUBLIC);
        if (!$rc->isEnum()) {
            foreach ($consts as $key => $val) {
                $val = str_replace("\\n", "nl", $val);
                if ($val == "") $val = ".";
                $s .= "| ``$key`` => ``$val``" . PHP_EOL;
            }
        }

        file_put_contents($rst_filename, $s);
        Log::debug("created file     : " . $rst_filename);
    }

    /**
     * @return array
     */
    public function getScannedDocuments(): array {
        return $this->scanned;
    }

    public function getClassHeadReader(): ClassHeadReaderInterface {
        $phpClassReader = Config::get()->getValue("php_class_reader");
        if (is_null($phpClassReader)) {
            $phpClassReader = new ClassHeadReader();
        }
        return $phpClassReader;
    }

}