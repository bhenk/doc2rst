<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\RstFile;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\work\ClassHeadReader;
use bhenk\doc2rst\work\ConstantsReader;
use bhenk\doc2rst\work\MethodLexer;
use ReflectionClass;
use function basename;
use function str_replace;
use function strlen;
use function substr;

class DocWorker {


    public function makeDoc(string $path): void {
        $doc_title = substr(basename($path), 0, -4);
        $rel_path = substr($path, strlen(RunConfiguration::getApplicationRoot()) + 1);
        $rel_path = substr($rel_path, 0, -4);
        $fq_classname = str_replace("/", "\\", $rel_path);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        $doc = new RstFile($doc_file);
        $doc->addEntry(new Label($fq_classname));
        $doc->addEntry(new Title($doc_title));

        $rc = new ReflectionClass($fq_classname);
        ProcessState::setCurrentClass($rc);
        $doc->addEntry(new ClassHeadReader());
        $doc->addEntry(new ConstantsReader());
        //$doc->addEntry(new ConstructorReader());
        $doc->addEntry(new MethodLexer($rc->getConstructor()));

        $doc->putContents();
        Log::debug("created " . $doc_title . " -> file://" . $doc_file);
        ProcessState::setCurrentClass(null);
    }

}