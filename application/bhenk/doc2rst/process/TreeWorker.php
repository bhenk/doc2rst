<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\RstFile;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\rst\TocTree;
use function array_diff;
use function array_key_exists;
use function basename;
use function dirname;
use function explode;
use function in_array;
use function is_dir;
use function is_file;
use function is_null;
use function mkdir;
use function scandir;
use function str_ends_with;
use function str_replace;
use function strlen;
use function strpos;
use function substr;
use function var_dump;

class TreeWorker {

    public function makeDocs(): void {
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
    }

    private function makeApiDoc(string $vendor, array $packages): void {
        $api_dir = RunConfiguration::getApiDirectory();
        if (!is_dir($api_dir)) {
            mkdir($api_dir, 0777, true);
        }
        $doc_title = RunConfiguration::getApiDocsTitle();
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $doc_title . ".rst";
        $doc = new RstFile($doc_file);
        $doc->addEntry(new Title($doc_title));

        $tocTree = new TocTree();
        $tocTree->setMaxDepth(RunConfiguration::getToctreeMaxDepth());
        $tocTree->setTitlesOnly(RunConfiguration::isToctreeTitlesOnly());
        foreach ($packages as $package) {
            $link = $vendor . "/" . $package . "/" . $package;
            $link_title = "package " . $vendor . "\\" . $package;
            $tocTree->addEntry($link, $link_title);
            $dirs = $api_dir . "/" . $vendor . "/" . $package;
            if (!is_dir($dirs)) mkdir($dirs, 0777, true);
        }
        $doc->addEntry($tocTree);
        $doc->putContents();
        Log::notice("created " . $doc_file);

        foreach ($packages as $package) {
            $dir = RunConfiguration::getVendorDirectory() . "/" . $package;
            $this->makeTree($dir);
        }
    }

    private function makeTree(string $dir): void {
        $doc_title = basename($dir);
        $rel_path = substr($dir, strlen(RunConfiguration::getApplicationRoot()) + 1);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        $doc = new RstFile($doc_file);
        $doc->addEntry(new Title($doc_title));
        $packageTocTree = new TocTree();
        $packageTocTree->setCaption("packages");
        $classTocTree = new TocTree();
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
        //Log::notice("created " . $doc_file);

        foreach ($included_files as $path) {
            if (is_dir($path)) {
                $this->makeTree($path);
            } elseif (is_file($path)) {
                if (str_ends_with($path, ".php")) {
                    $this->makeDoc($path);
                }
            }
        }
    }

    private function makeDoc(string $file): void {
        $doc_title = substr(basename($file), 0, -4);
        $rel_path = substr($file, strlen(RunConfiguration::getApplicationRoot()) + 1);
        $rel_path = substr($rel_path, 0, -4);
        $doc_file = RunConfiguration::getApiDirectory() . "/" . $rel_path . "/" . $doc_title . ".rst";
        Log::debug($doc_file);
        $doc = new RstFile($doc_file);
        $doc->addEntry(new Title($doc_title));
        $doc->addEntry(new Title("foo bar", 2));
        $doc->putContents();
        Log::notice("created dir " . dirname($doc_file));
        Log::debug("doc " . $file);
    }

    private function scanTree(int $level): void {
        $filenames = [];
        foreach (SourceState::getFileOrder() as $rel_path) {
            $rel = explode("/", $rel_path);
            $filename = $rel[$level] ?? null;
            if (!is_null($filename) and !strpos($filename, ".")) {
                if (!array_key_exists($filename, $filenames)) {
                    $filenames[$filename] = [];
                }
                $link_name = $rel[$level + 1] ?? null;
                if (!is_null($link_name)) {
//                    if (str_ends_with($link_name, ".php")) {
//                        $link_name = substr($link_name, 0, -4);
//                    }
                    if (!in_array($link_name, $filenames[$filename])) {
                        $filenames[$filename][] = $link_name;
                    }
                }
            }
        }
//        if (!empty($filenames)) {
//
//        }


        var_dump("level = " . $level);
        var_dump($filenames);
        $level++;
        if (!empty($filenames)) {
            $this->scanTree($level);
        }
    }

}