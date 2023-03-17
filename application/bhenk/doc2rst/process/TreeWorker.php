<?php /** @noinspection PhpUndefinedNamespaceInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\D2R;
use bhenk\doc2rst\globals\DocState;
use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\Document;
use bhenk\doc2rst\rst\DownloadList;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\rst\TocTree;
use bhenk\doc2rst\work\PhpParser;
use Throwable;
use function array_diff;
use function basename;
use function copy;
use function date;
use function explode;
use function file_get_contents;
use function in_array;
use function is_dir;
use function is_file;
use function mkdir;
use function pathinfo;
use function scandir;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strlen;
use function strrpos;
use function strtolower;
use function substr;

class TreeWorker {

    private int $package_count = 0;
    private int $class_count = 0;

    /**
     * Scans the *vendor_directory* and delegates complete creation of docs/api-tree
     *
     * Each directory in { {@link bhenk\doc2rst\globals\RC::vendor_directory vendor_directory} } is filtered against
     * {@link bhenk\doc2rst\globals\RC::excludes the array of excluded files}.
     * If it falls through it gets its own entry in the
     * { {@link bhenk\doc2rst\globals\RC::api_docs_title api_docs_title} } doc's toctree. Subsequently,
     * it is searched and documented in its own tree.
     *
     * @return void
     */
    public function walkTree(): void {
        $this->package_count = 0;
        $this->class_count = 0;
        $vendor = basename(RunConfiguration::getVendorDirectory());
        $files = array_diff(scandir(RunConfiguration::getVendorDirectory(),
            SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        $packages = [];
        foreach ($files as $file) {
            $namespace = $vendor . "\\" . $file;
            if (!in_array($namespace, RunConfiguration::getExcludes())) {
                $packages[] = $file;
            }
        }
        $this->makeApiDoc($vendor, $packages);
        Log::notice("Created "
            . $this->package_count
            . " package files and "
            . $this->class_count
            . " class files in "
            . RunConfiguration::getApiDirectory(), false);
    }

    private function makeApiDoc(string $vendor, array $packages): void {
        $api_dir = RunConfiguration::getApiDirectory();
        $doc_title = RunConfiguration::getApiDocsTitle();
        $doc_file = $api_dir . "/" . $doc_title . ".rst";
        $doc = new Document($doc_file);
        $doc->addEntry(new Title($doc_title));

        $tocTree = new TocTree();
        $tocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $tocTree->setTitlesOnly(RunConfiguration::getToctreeTitlesOnly());
        foreach ($packages as $package) {
            $dir = RunConfiguration::getVendorDirectory() . "/" . $package;
            $link = $vendor . "/" . $package . "/" . $package;
            if (is_dir($dir)) {
                $link_title = "package " . $vendor . "\\" . $package;
                $tocTree->addEntry($link, $link_title);
            }
        }
        $doc->addEntry($tocTree);
        $doc->putContents();
        Log::info("Created " . $doc_title . " -> file://" . $doc_file, false);

        foreach ($packages as $package) {
            $dir = RunConfiguration::getVendorDirectory() . "/" . $package;
            if (is_dir($dir)) $this->makeTree($dir);
        }
    }

    private function makeTree(string $dir): void {
        // $dir = {absolute}/vendor_dir/doc2rst/process
        // "process"
        $doc_title = basename($dir);
        // "bhenk/doc2rst/process"
        $rel_path = substr($dir, strlen(RunConfiguration::getApplicationRoot()) + 1);
        // {absolute}/doc_root/api_directory/bhenk/doc2rst/process
        $doc_path = RunConfiguration::getApiDirectory() . "/" . $rel_path;
        // {absolute}/doc_root/api_directory/bhenk/doc2rst/process/process.rst
        $doc_file = $doc_path . "/" . $doc_title . ".rst";
        // bhenk\doc2rst\process
        $fqn = str_replace("/", "\\", $rel_path);
        $doc = new Document($doc_file);
        $doc->addEntry(D2R::getStyles());
        $doc->addEntry(new Label($fqn));
        $doc->addEntry(new Title($doc_title));

        $packageTocTree = new TocTree();
        $packageTocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $packageTocTree->setTitlesOnly(RunConfiguration::getToctreeTitlesOnly());
        $packageTocTree->setCaption("packages");

        $classTocTree = new TocTree();
        $classTocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $classTocTree->setTitlesOnly(RunConfiguration::getToctreeTitlesOnly());
        $classTocTree->setCaption("classes");

        $filesTocTree = new TocTree();
        $filesTocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $filesTocTree->setTitlesOnly(RunConfiguration::getToctreeTitlesOnly());
        $filesTocTree->setCaption("php-files");

        $downloadList = new DownloadList("downloads");
        $package_file_contents = null;

        $helper = new TreeHelper();

        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        $included_files = [];
        foreach ($files as $file) {
            // {absolute}/vendor_dir/doc2rst/process/TreeWorker.php
            $path = $dir . "/" . $file;
            // bhenk/doc2rst/process/TreeWorker.php
            $rel_path = substr($path, strlen(RunConfiguration::getApplicationRoot()) + 1);
            // bhenk\doc2rst\process\TreeWorker
            $fqn = substr(str_replace("/", "\\", $rel_path), 0, -4);
            if (!in_array($fqn, RunConfiguration::getExcludes())) {
                $extension = substr($file, strrpos($file, "."));
                $included_files[] = $path;
                if (is_dir($path)) $packageTocTree->addEntry($file . "/" . $file);
                if (is_file($path) and str_ends_with($file, ".php")) {
                    $classname = substr($file, 0, -4);
                    $parser = new PhpParser();
                    $parser->parseFile($path);
                    $helper->addParser($parser, $fqn);
                    if ($parser->isPlainPhpFile()) {
                        $filesTocTree->addEntry($classname . "/" . $classname);
                    } else {
                        $classTocTree->addEntry($classname . "/" . $classname);
                    }
                }
                if (is_file($path) and in_array($extension, RunConfiguration::getDownloadFileExt())) {
                    // {absolute}/doc_root/api_directory/bhenk/doc2rst/process/text.txt
                    $doc_ex = $doc_path . DIRECTORY_SEPARATOR . $file;
                    if (!is_dir($doc_path)) mkdir($doc_path, 0777, true);
                    copy($path, $doc_ex);
                    // /api_directory/bhenk/doc2rst/process/text.txt
                    $link = "/" . basename(RunConfiguration::getApiDirectory()) . "/" . $rel_path;
                    $downloadList->addEntry($file, $link);
                    DocState::addAbsoluteFile($doc_ex);
                }
                if ($file == "package.rst") {
                    $package_file_contents = PHP_EOL . file_get_contents($path) . PHP_EOL;
                }
            }
        } // end foreach
        $doc->addEntry($helper->getEntries());
        if ($package_file_contents) {
            $doc->addEntry($package_file_contents);
            $lines = explode(PHP_EOL, $package_file_contents);
            foreach ($lines as $line) {
                if (str_starts_with($line, ".. download ")) {
                    $parts = explode(" ", $line);
                    $file = $parts[2] ?? "";
                    if (in_array($file, $files)) {
                        // {absolute}/doc_root/api_directory/bhenk/doc2rst/process/xxx.csv
                        $doc_ex = $doc_path . DIRECTORY_SEPARATOR . $file;
                        // {absolute}/vendor_dir/doc2rst/process/xxx.csv
                        $path = $dir . "/" . $file;
                        copy($path, $doc_ex);
                        // /api_directory/bhenk/doc2rst/process/xxx.csv
                        $link = "/" . basename(RunConfiguration::getApiDirectory())
                            . "/" . dirname($rel_path) . "/" . $file;
                        $downloadList->addEntry($file, $link);
                        DocState::addAbsoluteFile($doc_ex);
                    }
                }
            }
        }
        $doc->addEntry($packageTocTree);
        $doc->addEntry($classTocTree);
        $doc->addEntry($filesTocTree);
        $doc->addEntry($downloadList);
        if ($packageTocTree->isEmpty() and $classTocTree->isEmpty() and $downloadList->isEmpty()) {
            // empty directory
            $doc->addEntry("<no reported files>");
        }
        $doc->addEntry(PHP_EOL . "----" . PHP_EOL);
        if (RunConfiguration::getShowDatestamp()) {
            $doc->addEntry(":block:`" . date(DATE_RFC2822) . "` " . PHP_EOL);
        } else {
            $doc->addEntry(":block:`" . "no datestamp" . "` " . PHP_EOL);
        }
        $doc->putContents();
        $this->package_count++;
        Log::debug("created package file " . $doc_title . " -> file://" . $doc_file);

        foreach ($included_files as $path) {
            if (is_dir($path)) {
                $this->makeTree($path);
            } elseif (is_file($path)) {
                $this->makeDoc($path);
            }
        }
    }

    private function makeDoc(string $path): void {
        $ext = strtolower("." . strtolower(pathinfo($path, PATHINFO_EXTENSION)));
        try {
            if (strtolower($ext) == ".php") {
                $docWorker = new DocWorker();
                $document = $docWorker->processDoc($path);
                $document->putContents();
                $this->class_count++;
            } else {
                if (!in_array($ext, RunConfiguration::getDownloadFileExt()) and $ext != ".rst") {
                    Log::info("No DocWorker for file type " . $ext . " file://" . $path, false);
                }
            }
        } catch (Throwable $e) {
            Log::error("while parsing " . ProcessState::getPointer(), $e);
        }
    }

}