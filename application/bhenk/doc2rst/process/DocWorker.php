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
use ReflectionClassConstant;
use ReflectionException;
use ReflectionMethod;
use Throwable;
use function basename;
use function count;
use function dirname;
use function file_exists;
use function file_get_contents;
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
            Log::debug("Not a class file: file://" . $path . " message: " . $e->getMessage());
            return;
        }
        ProcessState::setCurrentClass($rc);

        $doc_title = substr(basename($path), 0, -4);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        $doc = new RstFile($doc_file);

        try {
            $doc->addEntry(D2R::getStyles());
            $doc->addEntry(new Label($fq_classname));
            $doc->addEntry(new Title($doc_title));

            $doc->addEntry(new ClassLexer($rc));

            if (RunConfiguration::getShowClassContents()) {
                $doc->addEntry(".. contents::" . PHP_EOL . PHP_EOL);
                $doc->addEntry("----" . PHP_EOL);
            }

            $constants = $rc->getReflectionConstants(ReflectionClassConstant::IS_PUBLIC
                | ReflectionClassConstant::IS_PROTECTED);
            $methods = $rc->getMethods(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED);

            if (!empty($constants)) {
                $doc->addEntry(new Label($fq_classname . "::Constants"));
                $doc->addEntry(new Title("Constants", 1));
                $constant_count = 0;
                foreach ($constants as $constant) {
                    $constant_count++;
                    $doc->addEntry(new ConstantLexer($constant));
                    $doc->addEntry("----" . PHP_EOL);
                }
            }

            $method_count = 0;
            if (!is_null($rc->getConstructor())) {
                $method_count++;
                $doc->addEntry(new Label($fq_classname . "::Constructor"));
                $doc->addEntry(new Title("Constructor", 1));
                $doc->addEntry(new MethodLexer($rc->getConstructor()));
                $doc->addEntry("----" . PHP_EOL);
            }


            if (count($methods) > $method_count) {
                $doc->addEntry(new Label($fq_classname . "::Methods"));
                $doc->addEntry(new Title("Methods", 1));
                foreach ($methods as $method) {
                    if ($method->name != "__construct") {
                        $doc->addEntry(new MethodLexer($method));
                        $doc->addEntry("----" . PHP_EOL);
                    }
                }
            }
            $doc->addEntry(":block:`" . date(DATE_RFC2822) . "` " . PHP_EOL);

            $doc->putContents();

            Log::debug("created " . $doc_title . " -> file://" . $doc_file);
        } catch (Throwable $e) {
            Log::error("Caught exception while transforming " . ProcessState::getCurrentFile(), $e);
        } finally {
            ProcessState::setCurrentClass(null);
        }

    }

}