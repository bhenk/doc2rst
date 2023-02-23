<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\RstFile;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\rst\TocTree;
use function array_diff;
use function basename;
use function in_array;
use function is_dir;
use function is_file;
use function pathinfo;
use function scandir;
use function str_ends_with;
use function str_replace;
use function strlen;
use function strtolower;
use function substr;

class TreeWorker {

    private int $package_count = 0;
    private int $class_count = 0;

    public function makeDocs(): void {
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
            . RunConfiguration::getApiDirectory());
    }

    private function makeApiDoc(string $vendor, array $packages): void {
        $api_dir = RunConfiguration::getApiDirectory();
        $doc_title = RunConfiguration::getApiDocsTitle();
        $doc_file = $api_dir . "/" . $doc_title . ".rst";
        $doc = new RstFile($doc_file);
        $doc->addEntry(new Title($doc_title));

        $tocTree = new TocTree();
        $tocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $tocTree->setTitlesOnly(RunConfiguration::isToctreeTitlesOnly());
        foreach ($packages as $package) {
            $link = $vendor . "/" . $package . "/" . $package;
            $link_title = "package " . $vendor . "\\" . $package;
            $tocTree->addEntry($link, $link_title);
        }
        $doc->addEntry($tocTree);
        $doc->putContents();
        Log::info("Created " . $doc_title . " -> file://" . $doc_file);

        foreach ($packages as $package) {
            $dir = RunConfiguration::getVendorDirectory() . "/" . $package;
            $this->makeTree($dir);
        }
    }

    private function makeTree(string $dir): void {
        $doc_title = basename($dir);
        $rel_path = substr($dir, strlen(RunConfiguration::getApplicationRoot()) + 1);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        $namespace = str_replace("/", "\\", $rel_path);
        $doc = new RstFile($doc_file);
        $doc->addEntry(new Label($namespace));
        $doc->addEntry(new Title($doc_title));

        $packageTocTree = new TocTree();
        $packageTocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $packageTocTree->setTitlesOnly(RunConfiguration::isToctreeTitlesOnly());
        $packageTocTree->setCaption("packages");

        $classTocTree = new TocTree();
        $classTocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $classTocTree->setTitlesOnly(RunConfiguration::isToctreeTitlesOnly());
        $classTocTree->setCaption("classes");

        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        $included_files = [];
        foreach ($files as $file) {
            $path = $dir . "/" . $file;
            $rel_path = substr($path, strlen(RunConfiguration::getApplicationRoot()) + 1);
            $namespace = str_replace("/", "\\", $rel_path);
            if (!in_array($namespace, RunConfiguration::getExcludes())) {
                $included_files[] = $path;
                if (is_dir($path)) $packageTocTree->addEntry($file . "/" . $file);
                if (is_file($path) and str_ends_with($file, ".php")) {
                    $classname = substr($file, 0, -4);
                    $classTocTree->addEntry($classname . "/" . $classname);
                }
            }
        }
        $doc->addEntry($packageTocTree);
        $doc->addEntry($classTocTree);
        $doc->putContents();
        $this->package_count++;
        Log::debug("created " . $doc_title . " -> file://" . $doc_file);

        foreach ($included_files as $path) {
            if (is_dir($path)) {
                $this->makeTree($path);
            } elseif (is_file($path)) {
                $this->makeDoc($path);
            }
        }
    }

    private function makeDoc(string $path): void {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if ($ext == "php") {
            $docWorker = new DocWorker();
            $docWorker->makeDoc($path);
            $this->class_count++;
        } else {
            Log::info("No DocWorker for file type " . $ext . " file://" . $path);
        }
    }

}