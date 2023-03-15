<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\D2R;
use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\Document;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Table;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\tag\InheritdocTag;
use bhenk\doc2rst\work\PhpParser;
use ReflectionClass;
use ReflectionFunction;
use function addslashes;
use function basename;
use function count;
use function date;
use function get_included_files;
use function in_array;
use function str_contains;
use function str_replace;
use function strlen;
use function substr;

class DocWorker {

    private Document $doc;


    /**
     * @param string $path absolute path to a file, with extension '*.php*'
     * @return Document
     */
    public function processDoc(string $path): Document {
        //Log::debug("processing -> file://" . $path);
        $length = RunConfiguration::getApplicationRoot() ? strlen(RunConfiguration::getApplicationRoot()) : 0;
        $rel_path = substr($path, $length + 1);
        $rel_path = substr($rel_path, 0, -4);
        $parser = new PhpParser();
        $parser->parseFile($path);
        ProcessState::setCurrentParser($parser);

        if (!in_array($path, get_included_files())) include $path;

        // in this form only used for labels
        $fq_name = $parser->getFQName() ?? str_replace("/", "\\", $rel_path);
        // for files without a namespace use rel_path as unique label
        if (!str_contains($fq_name, "\\")) $fq_name = str_replace("/", "\\", $rel_path);

        $doc_title = substr(basename($path), 0, -4);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        $this->doc = new Document($doc_file);
        $this->doc->addEntry(D2R::getStyles());
        $this->doc->addEntry(new Label($fq_name));
        $this->doc->addEntry(new Title($doc_title));
        $fork = $this->forkProcess($parser, $fq_name);
        if (RunConfiguration::getShowDatestamp()) {
            $this->doc->addEntry(":block:`" . date(DATE_RFC2822) . "` " . PHP_EOL);
        } else {
            $this->doc->addEntry(":block:`" . "no datestamp" . "` " . PHP_EOL);
        }
        Log::debug("completed " . $fork . " -> file://" . $path);
        return $this->doc;
    }

    private function forkProcess(PhpParser $parser, string $fq_name): string {
        $fork = "";
        if ($parser->isPlainPhpFile()) {
            Log::debug("processing plain file://" . $parser->getFilename());
            $fork = "plain";
            $this->processPlain($parser, $fq_name);
        } else {
            $reflectionClass = new ReflectionClass($fq_name);
            ProcessState::setCurrentClass($reflectionClass);
            Log::debug("processing class file://" . $parser->getFilename());
            $fork = "class";
            $this->processClass($reflectionClass);
            ProcessState::setCurrentClass(null);
        }
        ProcessState::setCurrentParser(null);
        return $fork;
    }

    private function processPlain(PhpParser $parser, string $fq_name): void {
        // namespace doc comment
        $ns_struct = $parser->getNamespace();
        if ($ns_struct) $this->doc->addEntry(new CommentLexer($ns_struct->getDocComment()));

        // namespace and features
        $features = [];
        if ($parser->isPhp()) $features[] = "php-file";
        if ($parser->hasInlineHtml()) $features[] = "inline HTML";
        $table = new Table(2);
        $namespace = $ns_struct ? $ns_struct->getValue() : "no namespace";
        $table->addRow("namespace", addslashes($namespace));
        if (!empty($features)) $table->addRow("features", implode(" | ", $features));
        $this->doc->addEntry($table);

        // contents
        if (RunConfiguration::getShowClassContents()) {
            $this->doc->addEntry(".. contents::" . PHP_EOL . PHP_EOL);
            $this->doc->addEntry("----" . PHP_EOL);
        }

        // constants
        if (!empty($parser->getConstants())) {
            $this->doc->addEntry(new Label($fq_name . "::Constants"));
            $this->doc->addEntry(new Title("Constants", 1));
            $this->printStructs($parser->getConstants(), $fq_name, $parser->getShortName());
        }

        // functions
        if (!empty($parser->getFunctions())) {
            $this->doc->addEntry(new Label($fq_name . "::Functions"));
            $this->doc->addEntry(new Title("Functions", 1));
            include $parser->getFilename();
            foreach ($parser->getFunctions() as $function) {
                $function_name = $parser->getNamespace()->getValue() . "\\" . $function->getName();
                $reflection = new ReflectionFunction($function_name);
                $this->doc->addEntry(new FunctionLexer($reflection, $fq_name, $parser->getShortName()));
                $this->doc->addEntry("----" . PHP_EOL);
            }
        }

        $struct = $parser->getReturn();
        if ($struct and $struct->getDocComment()) {
            $this->doc->addEntry(new Label($fq_name . "::Return"));
            $this->doc->addEntry(new Title("Return", 1));
            $this->doc->addEntry(new CommentLexer($struct->getDocComment()));
            $this->doc->addEntry("----" . PHP_EOL);
        }
    }

    private function printStructs(array $structs, string $fq_classname, string $shortname): void {
        foreach ($structs as $struct) {
            $label = $fq_classname . "::" . $struct->getName();
            $title = $shortname . "::" . $struct->getName();
            $this->doc->addEntry(new Label($label));
            $this->doc->addEntry(new Title($title, 2));
            if ($struct->getDocComment()) {
                $this->doc->addEntry(new CommentLexer($struct->getDocComment()));
            } else {
                $this->doc->addEntry("\ <no documentation>" . PHP_EOL);
            }
            $this->doc->addEntry(PHP_EOL . "----" . PHP_EOL);
        }
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return void
     */
    private function processClass(ReflectionClass $reflectionClass): void {
        CommentHelper::resetReportedClasses();
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