<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\conf\Config;
use bhenk\doc2rst\log\Log;
use function array_diff;
use function basename;
use function dirname;
use function file_put_contents;
use function in_array;
use function is_dir;
use function is_file;
use function mkdir;
use function rmdir;
use function scandir;
use function str_ends_with;
use function str_repeat;
use function str_starts_with;
use function strlen;
use function substr;
use function unlink;

class DirectoryCrawler {

    //private string $application_directory;
    private string $source_directory;
    private string $api_root;
    private int $input_prefix;
    private array $excludes;
    private int $files_created = 0;
    private int $directories_created = 0;

    function __construct() {
        $application_root = Config::get()->getValue("application_root");
        $this->source_directory = Config::get()->getValue("source_directory");
        $this->api_root = Config::get()->getValue("api_directory");
        // subtract from path and you have namespace
        $this->input_prefix = strlen($application_root) + 1;
        $this->excludes = Config::get()->getValue("excludes") ?? [];
    }

    public function makeDocumentTree(): void {
        Log::debug("Clearing api directory: " . $this->api_root);
        $r = $this->clearOutput($this->api_root, -1, 0, 0);
        Log::debug("Removed $r[1] directories and $r[0] files");

        $source_directory = Config::get()->getValue("source_directory");
        $scanned = $this->scanInput($source_directory, []);
        Config::get()->getDocManager()->setScannedDocuments($scanned);
        Log::debug("Scanned " . count($scanned) . "files");

        $title = Config::get()->getValue("api_docs_name") ?? "api-docs";
        $this->makeTree($title, dirname($source_directory), -1);
        Log::notice("Created $this->directories_created directories and $this->files_created files");
    }

    private function clearOutput(string $dir, int $level, $removed_files, $removed_directories): array {
        $level++;
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            if (is_dir("$dir/$file")) {
                $this->clearOutput("$dir/$file", $level, $removed_files, $removed_directories);
            } else {
                unlink("$dir/$file");
                $removed_files++;
            }
        }
        if ($level > 0) {
            rmdir($dir);
            $removed_directories++;
        }
        return [$removed_files, $removed_directories];
    }

    private function scanInput(string $dir, array $arr): array {
        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            $rel_path = substr($path, $this->input_prefix);
            if (!in_array($rel_path, $this->excludes)) {
                if (is_dir($path)) {
                    $arr = $this->scanInput($path, $arr);
                } else {
                    $arr[] = $rel_path;
                }
            }
        }
        return $arr;
    }

    private function makeTree(string $heading, string $dir, $level): void {
        $level++;
        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        $toctree = [];
        $file_list = [];
        foreach ($files as $ford) {
            $path = $dir . DIRECTORY_SEPARATOR . $ford;
            $rel_path = substr($path, $this->input_prefix);
            if (!in_array($rel_path, $this->excludes)) {
                if (is_dir($path)) {
                    if (str_starts_with($path, $this->source_directory)) {
                        $toctree[] = $ford;
                    }
                } elseif (is_file($path)) {
                    if (str_ends_with($path, ".php")) {
                        $file_list[] = basename($path, ".php");
                    }
                }
            }
        }
        $inBetween = DIRECTORY_SEPARATOR . substr($dir, $this->input_prefix);
        if ($inBetween == DIRECTORY_SEPARATOR) $inBetween = "";
        $workdir = $this->api_root . $inBetween;
        Log::debug("................. level " . $level);
        Log::debug("scanned directory: " . $dir);
        $this->makeNode($heading, $toctree, $file_list, $workdir);
        foreach ($toctree as $ford) {
            $path = $dir . DIRECTORY_SEPARATOR . $ford;
            $this->makeTree($ford, $path, $level);
        }
        foreach ($file_list as $ford) {
            $path = $dir;
            $this->makeDocument($ford, $path, $workdir);
        }
    }

    private function makeNode(string $heading, array $toctree, array $file_list, string $workdir): void {
        $s = $heading . PHP_EOL
            . str_repeat("=", strlen($heading)) . PHP_EOL
            . PHP_EOL
            . ".. toctree::" . PHP_EOL
            . "   :maxdepth: 1" . PHP_EOL . PHP_EOL;
        foreach ($toctree as $line) {
            $s .= "   $line/$line" . PHP_EOL;
            $make_dir = $workdir . DIRECTORY_SEPARATOR . $line;
            mkdir($make_dir);
            Log::debug("created directory: " . $make_dir);
            $this->directories_created++;
        }
        foreach ($file_list as $line) {
            $s .= "   $line" . PHP_EOL;
        }
        $filename = $workdir . DIRECTORY_SEPARATOR . $heading . ".rst";
        file_put_contents($filename, $s);
        Log::debug("created file     : " . $filename);
        $this->files_created++;
    }

    private function makeDocument(string $classname, string $path, string $workdir): void {
        Config::get()->getDocManager()->makeDocument($classname, $path, $workdir);
    }

}