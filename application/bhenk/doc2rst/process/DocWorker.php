<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\RstFile;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\work\ClassHeadReader;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;
use ReflectionMethod;
use Throwable;
use function basename;
use function count;
use function is_null;
use function str_replace;
use function strlen;
use function substr;

class DocWorker {


    /**
     * @param string $path
     */
    public function makeDoc(string $path): void {
        $rel_path = substr($path, strlen(RunConfiguration::getApplicationRoot()) + 1);
        $rel_path = substr($rel_path, 0, -4);
        $fq_classname = str_replace("/", "\\", $rel_path);

        try {
            $rc = new ReflectionClass($fq_classname);
        } catch (ReflectionException $e) {
            Log::info("Not a class file: file://" . $path . " message: " . $e->getMessage());
            return;
        }
        ProcessState::setCurrentClass($rc);
        $doc_title = substr(basename($path), 0, -4);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        $doc = new RstFile($doc_file);

        try {
            $doc->addEntry(new Label($fq_classname));
            $doc->addEntry(new Title($doc_title));
            $doc->addEntry(new ClassHeadReader());
            if (RunConfiguration::isShowClassContents()) {
                $doc->addEntry(".. contents::" . PHP_EOL . PHP_EOL);
                $doc->addEntry("----" . PHP_EOL);
            }

            //$doc->addEntry(new ConstantsReader());
            $constants = $rc->getReflectionConstants(ReflectionClassConstant::IS_PUBLIC
                | ReflectionClassConstant::IS_PROTECTED);
            if (!empty($constants)) {
                $doc->addEntry(new Label($fq_classname . "::Constants"));
                $doc->addEntry(new Title("Constants", 1));
                $constant_count = 0;
                foreach ($constants as $constant) {
                    $constant_count++;
                    $doc->addEntry(new ConstantLexer($constant));
                    if ($constant_count < count($constants)) $doc->addEntry("----" . PHP_EOL);
                }
            }

            if (!is_null($rc->getConstructor())) {
                $doc->addEntry(new Label($fq_classname . "::Constructor"));
                $doc->addEntry(new Title("Constructor", 1));
                $doc->addEntry(new MethodLexer($rc->getConstructor()));
                $doc->addEntry("----" . PHP_EOL);
            }
            $methods = $rc->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED);
            if (count($methods) > 1) {
                $doc->addEntry(new Label($fq_classname . "::Methods"));
                $doc->addEntry(new Title("Methods", 1));
                $method_count = 0;
                foreach ($methods as $method) {
                    $method_count++;
                    if ($method->name != "__construct") {
                        $doc->addEntry(new MethodLexer($method));
                        if ($method_count < count($methods)) $doc->addEntry("----" . PHP_EOL);
                    }
                }
            }
            $doc->putContents();
            Log::debug("created " . $doc_title . " -> file://" . $doc_file);
        } catch (Throwable $e) {
            Log::error("Caught exception while transforming " . ProcessState::getCurrentFile(), $e);
        } finally {
            ProcessState::setCurrentClass(null);
        }

    }

}