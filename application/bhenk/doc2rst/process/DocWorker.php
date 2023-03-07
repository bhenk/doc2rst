<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\D2R;
use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\RstFile;
use bhenk\doc2rst\rst\Title;
use ReflectionClass;
use ReflectionException;
use function basename;
use function count;
use function date;
use function str_replace;
use function strlen;
use function substr;

class DocWorker {

    private RstFile $doc;

    function __construct(string $path) {
        $this->processDoc($path);
    }

    private function processDoc(string $path): void {
        $rel_path = substr($path, strlen(RunConfiguration::getApplicationRoot()) + 1);
        $rel_path = substr($rel_path, 0, -4);
        $fq_classname = str_replace("/", "\\", $rel_path);
        $doc_title = substr(basename($path), 0, -4);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        $this->doc = new RstFile($doc_file);
        $this->doc->addEntry(D2R::getStyles());
        $this->doc->addEntry(new Label($fq_classname));
        $this->doc->addEntry(new Title($doc_title));
        $this->forkProcess($path, $fq_classname);
        $this->doc->addEntry(":block:`" . date(DATE_RFC2822) . "` " . PHP_EOL);
        $this->doc->putContents();
        Log::debug("created " . $doc_title . " -> file://" . $doc_file);
    }

    private function forkProcess(string $path, string $fq_classname): void {
        $reflectionClass = null;
        try {
            $reflectionClass = new ReflectionClass($fq_classname);
        } catch (ReflectionException $e) {
            Log::debug("Not a class file: file://" . $path . " message: " . $e->getMessage());
        }
        if ($reflectionClass) {
            ProcessState::setCurrentClass($reflectionClass);
            $this->processClass($reflectionClass);
            ProcessState::setCurrentClass(null);
        }
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return void
     */
    public function processClass(ReflectionClass $reflectionClass): void {
        $this->doc->addEntry(new ClassLexer($reflectionClass));

        if (RunConfiguration::getShowClassContents()) {
            $this->doc->addEntry(".. contents::" . PHP_EOL . PHP_EOL);
            $this->doc->addEntry("----" . PHP_EOL);
        }

        $constants = $reflectionClass->getReflectionConstants(RunConfiguration::getShowVisibility());
        $methods = $reflectionClass->getMethods(RunConfiguration::getShowVisibility());

        if (!empty($constants)) {
            $this->doc->addEntry(new Label($reflectionClass->getName() . "::Constants"));
            $this->doc->addEntry(new Title("Constants", 1));
            $constant_count = 0;
            foreach ($constants as $constant) {
                $constant_count++;
                $this->doc->addEntry(new ConstantLexer($constant));
                $this->doc->addEntry("----" . PHP_EOL);
            }
        }

        $method_count = 0;
        $found_constructor = false;
        foreach ($methods as $method) {
            if ($method->isConstructor()) $found_constructor = true;
        }
        if ($found_constructor) {
            $method_count++;
            $this->doc->addEntry(new Label($reflectionClass->getName() . "::Constructor"));
            $this->doc->addEntry(new Title("Constructor", 1));
            $this->doc->addEntry(new MethodLexer($reflectionClass->getConstructor()));
            $this->doc->addEntry("----" . PHP_EOL);
        }


        if (count($methods) > $method_count) {
            $this->doc->addEntry(new Label($reflectionClass->getName() . "::Methods"));
            $this->doc->addEntry(new Title("Methods", 1));
            foreach ($methods as $method) {
                if (!$method->isConstructor()) {
                    $this->doc->addEntry(new MethodLexer($method));
                    $this->doc->addEntry("----" . PHP_EOL);
                }
            }
        }
    }
}