<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\FileTypes;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\RstFile;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\rst\TocTree;
use function array_diff;
use function array_merge;
use function dirname;
use function explode;
use function in_array;
use function is_dir;
use function mkdir;
use function pathinfo;
use function scandir;
use function str_contains;
use function strlen;
use function strtolower;
use function substr;

class SourceScout {

    private int $input_prefix;

    function __construct() {
        $application_root = RunConfiguration::getApplicationRoot();
        $this->input_prefix = strlen($application_root) + 1;
    }

    public function scanSource(): void {
        $this->scanDirectories(RunConfiguration::getSourceDirectory());
    }

    private function scanDirectories(string $dir): void {
        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            $rel_path = substr($path, $this->input_prefix);
            if (!in_array($rel_path, RunConfiguration::getExcludes())) {
                if (is_dir($path)) {
                    SourceState::addDirectory($rel_path);
                    $this->scanDirectories($path);
                } else {
                    $this->addScannedFile($rel_path);
                }
            }
        }
    }

    private function addScannedFile(string $rel_path): void {
        $ext = strtolower(pathinfo($rel_path, PATHINFO_EXTENSION));
        switch ("$ext") {
            case "php":
                SourceState::addPhpFile($rel_path);
                break;
            case "js":
                SourceState::addJsFile($rel_path);
                break;
            case "sql":
                SourceState::addSqlFile($rel_path);
                break;
            case "md":
                SourceState::addMdFile($rel_path);
                break;
            case "rst":
                SourceState::addRstFile($rel_path);
                break;
            default:
                SourceState::addOtherFile($rel_path);
        }
    }

    /**
     * Makes a directory tree in docs/api folder that mirrors the one encountered in application root.
     *
     * @return int number of directories actually created
     */
    public function makeDirectories(): int {
        $api = RunConfiguration::getApiDirectory();
        $count = 0;
        if (!is_dir($api)) {
            $count += mkdir($api, 0777, true);
            Log::debug("mkdir " . $api);
        }
        foreach (SourceState::getDirectories() as $rel_path) {
            $abs_path = $api . DIRECTORY_SEPARATOR . $rel_path;
            if (!is_dir($abs_path)) {
                $count += mkdir($abs_path, 0777, true);
                Log::debug("mkdir " . $abs_path);
            }
        }
        return $count;
    }

    /**
     * Makes a directory tree in docs/api folder that mirrors the ones in application root where php-files were found.
     *
     * @return int number of directories actually created
     */
    public function makePhpDirectories(): int {
        return $this->makeFileDirectories(SourceState::getPhpFiles());
    }

    /**
     * Makes a directory tree in docs/api folder that mirrors the ones in application root where md-files were found.
     *
     * @return int number of directories actually created
     */
    public function makeMdDirectories(): int {
        return $this->makeFileDirectories(SourceState::getMdFiles());
    }

    /**
     * Makes a directory tree in docs/api folder that mirrors the ones in application root where rst-files were found.
     *
     * @return int number of directories actually created
     */
    public function makeRstDirectories(): int {
        return $this->makeFileDirectories(SourceState::getRstFiles());
    }

    private function makeFileDirectories(array $filenames): int {
        $api = RunConfiguration::getApiDirectory();
        $count = 0;
        if (!is_dir($api)) {
            $count += mkdir($api, 0777, true);
            Log::debug("mkdir " . $api);
        }
        foreach ($filenames as $rel_path) {
            $abs_path = dirname($api . DIRECTORY_SEPARATOR . $rel_path);
            if (!is_dir($abs_path)) {
                $count += mkdir($abs_path, 0777, true);
                Log::debug("mkdir " . $abs_path);
            }
        }
        return $count;
    }

    public function makeTocFiles(int $flags): int {
        $all = [];
        if (FileTypes::PHP & $flags == FileTypes::PHP) {
            $all = array_merge($all, SourceState::getPhpFiles());
            $this->makePhpDirectories();
        }
        if (FileTypes::MD & $flags == FileTypes::MD) {
            $all = array_merge($all, SourceState::getMdFiles());
            $this->makeMdDirectories();
        }
        if (FileTypes::RST & $flags == FileTypes::RST) {
            $all = array_merge($all, SourceState::getRstFiles());
            $this->makeRstDirectories();
        }

        $api_docs = new RstFile("api-docs");
        $api_docs->addEntry(new Title("api-docs"));
        $toc_tree = new TocTree();
        $api_docs->addEntry($toc_tree);
        foreach ($all as $rel_path) {
            $segments = explode("/", $rel_path);
            if (!str_contains($segments[0], ".")) {
                $toc_tree->addEntry($segments[0] . "/" . $segments[0]);
            } else {
                $toc_tree->addEntry($segments[0]);
            }
        }
        echo $api_docs;

        return 0;
    }

}