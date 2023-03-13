<?php

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
use Throwable;
use function array_diff;
use function basename;
use function copy;
use function date;
use function file_get_contents;
use function in_array;
use function is_dir;
use function is_file;
use function pathinfo;
use function scandir;
use function str_ends_with;
use function str_replace;
use function strlen;
use function strrpos;
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
            $link = $vendor . "/" . $package . "/" . $package;
            $link_title = "package " . $vendor . "\\" . $package;
            $tocTree->addEntry($link, $link_title);
        }
        $doc->addEntry($tocTree);
        $doc->putContents();
        Log::info("Created " . $doc_title . " -> file://" . $doc_file, false);

        foreach ($packages as $package) {
            $dir = RunConfiguration::getVendorDirectory() . "/" . $package;
            $this->makeTree($dir);
        }
    }

    private function makeTree(string $dir): void {
        $doc_title = basename($dir);
        $rel_path = substr($dir, strlen(RunConfiguration::getApplicationRoot()) + 1);
        $doc_path = RunConfiguration::getApiDirectory() . "/" . $rel_path;
        $doc_file = $doc_path . "/" . $doc_title . ".rst";
        $namespace = str_replace("/", "\\", $rel_path);
        $doc = new Document($doc_file);
        $doc->addEntry(D2R::getStyles());
        $doc->addEntry(new Label($namespace));
        $doc->addEntry(new Title($doc_title));

        $packageTocTree = new TocTree();
        $packageTocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $packageTocTree->setTitlesOnly(RunConfiguration::getToctreeTitlesOnly());
        $packageTocTree->setCaption("packages");

        $classTocTree = new TocTree();
        $classTocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $classTocTree->setTitlesOnly(RunConfiguration::getToctreeTitlesOnly());
        $classTocTree->setCaption("classes");

        $downloadList = new DownloadList("downloads");
        $package_file = null;

        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        $included_files = [];
        foreach ($files as $file) {
            $path = $dir . "/" . $file;
            $rel_path = substr($path, strlen(RunConfiguration::getApplicationRoot()) + 1);
            $namespace = str_replace("/", "\\", $rel_path);
            if (!in_array($namespace, RunConfiguration::getExcludes())) {
                $extension = substr($file, strrpos($file, "."));
                $included_files[] = $path;
                if (is_dir($path)) $packageTocTree->addEntry($file . "/" . $file);
                if (is_file($path) and str_ends_with($file, ".php")) {
                    $classname = substr($file, 0, -4);
                    $classTocTree->addEntry($classname . "/" . $classname);
                }
                if (is_file($path) and in_array($extension, RunConfiguration::getDownloadableFileExtensions())) {
                    $doc_ex = $doc_path . DIRECTORY_SEPARATOR . $file;
                    copy($path, $doc_ex);
                    $link = "/" . basename(RunConfiguration::getApiDirectory()) . "/" . $rel_path;
                    $downloadList->addEntry($file, $link);
                    DocState::addAbsoluteFile($doc_ex);
                }
                if ($file == "package.rst") {
                    $package_file = PHP_EOL . file_get_contents($path) . PHP_EOL;
                }
            }
        }
        if ($package_file) $doc->addEntry($package_file);
        $doc->addEntry($packageTocTree);
        $doc->addEntry($classTocTree);
        $doc->addEntry($downloadList);
        if ($packageTocTree->isEmpty() and $classTocTree->isEmpty() and $downloadList->isEmpty()) {
            // empty directory
            $doc->addEntry("<no reported files>");
        }
        $doc->addEntry(PHP_EOL . "----" . PHP_EOL);
        $doc->addEntry(":block:`" . date(DATE_RFC2822) . "` " . PHP_EOL);
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
            if ($ext == ".php") {
                $docWorker = new DocWorker();
                $document = $docWorker->processDoc($path);
                $document->putContents();
                $this->class_count++;
            } else {
                if (!in_array($ext, RunConfiguration::getDownloadableFileExtensions())) {
                    Log::info("No DocWorker for file type " . $ext . " file://" . $path, false);
                }
            }
        } catch (Throwable $e) {
            Log::error("while parsing " . ProcessState::getCurrentFile(), $e);
        }
    }

}