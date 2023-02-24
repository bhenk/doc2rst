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
use ReflectionException;
use ReflectionMethod;
use Throwable;
use function basename;
use function is_null;
use function str_replace;
use function strlen;
use function substr;

class DocWorker {


    /**
     * @throws ReflectionException
     */
    public function makeDoc(string $path): void {
        $doc_title = substr(basename($path), 0, -4);
        $rel_path = substr($path, strlen(RunConfiguration::getApplicationRoot()) + 1);
        $rel_path = substr($rel_path, 0, -4);
        $fq_classname = str_replace("/", "\\", $rel_path);
        $rc = new ReflectionClass($fq_classname);
        ProcessState::setCurrentClass($rc);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        $doc = new RstFile($doc_file);

        try {
            $doc->addEntry(new Label($fq_classname));
            $doc->addEntry(new Title($doc_title));
            $doc->addEntry(new ClassHeadReader());
            $doc->addEntry(new ConstantsReader());
            if (!is_null($rc->getConstructor())) {
                $doc->addEntry(new Label($fq_classname . "::Constructor"));
                $doc->addEntry(new Title("Constructor", 1));
                $doc->addEntry(new MethodLexer($rc->getConstructor()));
            }
            $methods = $rc->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED);
            if (!empty($methods)) {
                $doc->addEntry(new Label($fq_classname . "::Methods"));
                $doc->addEntry(new Title("Methods", 1));
                foreach ($methods as $method) {
                    if ($method->name != "__construct") {
                        $doc->addEntry(new MethodLexer($method));
                    }
                }
            }
            $doc->putContents();
            Log::debug("created " . $doc_title . " -> file://" . $doc_file);
        } catch (Throwable $e) {
            Log::error("Caught exception while transforming " . $rc->getFileName(), $e);
            //exit(1);
        } finally {
            ProcessState::setCurrentClass(null);
        }

    }

}