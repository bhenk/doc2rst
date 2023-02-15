<?php

namespace bhenk\doc2rst;

use Exception;
use PHPUnit\TextUI\XmlConfiguration\Php;
use function array_diff;
use function array_slice;
use function basename;
use function dirname;
use function explode;
use function file_put_contents;
use function implode;
use function in_array;
use function is_dir;
use function is_file;
use function mkdir;
use function PHPUnit\Framework\stringEndsWith;
use function realpath;
use function rmdir;
use function scandir;
use function str_ends_with;
use function str_repeat;
use function str_replace;
use function str_starts_with;
use function strlen;
use function strpos;
use function strrpos;
use function substr;
use function unlink;
use function var_dump;

class Crawler {
    private readonly string $input_dir;
    private readonly string $output_dir;

    private int $removed_files;
    private int $removed_directories;
    private int $files_created;
    private int $directories_created;
    private array $scanned = [];


    /**
     * Constructs a crawler.
     *
     * @param string $input_dir
     * @param string $output_dir
     * @param array $excludes
     * @throws Exception
     */
    function __construct(string        $input_dir,
                         string        $output_dir,
                         private array $excludes = []
    ) {
        $this->input_dir = realpath($input_dir);
        $this->output_dir = realpath($output_dir);
        if (!$input_dir or !is_dir($input_dir)) {
            throw new Exception("Input directory does not exist or is not a directory: " . $input_dir);
        }
        if (!$output_dir or !is_dir($output_dir)) {
            throw new Exception("Output directory does not exist or is not a directory: " . $output_dir);
        }
    }

    /**
     * @return string
     */
    public function getInputDir(): string {
        return $this->input_dir;
    }

    /**
     * @return string
     */
    public function getOutputDir(): string {
        return $this->output_dir;
    }

    /**
     * @return array
     */
    public function getExcludes(): array {
        return $this->excludes;
    }

    public function addExclude(string $exclude): void {
        $this->excludes[] = $exclude;
    }

    public function makeDocumentTree(): void {
        $this->removed_files = 0;
        $this->removed_directories = 0;
        $this->clearOutput($this->output_dir, -1);
        echo "removed directories: $this->removed_directories, removed files: $this->removed_files" . PHP_EOL;

        $this->scanned = $this->scanInput($this->input_dir, []);
        echo "scanned " . count($this->scanned) . " input files" . PHP_EOL;

        $this->files_created = 0;
        $this->directories_created = 0;

        $this->makeTree("api-docs", dirname($this->input_dir), -1);
        echo "***********************************" . PHP_EOL;
        echo "directories created: " . $this->directories_created .PHP_EOL;
        echo "files created      : " . $this->files_created .PHP_EOL;
    }

    private function clearOutput(string $dir, int $level): void {
        $level++;
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            if (is_dir("$dir/$file")) {
                $this->clearOutput("$dir/$file", $level);
            } else {
                unlink("$dir/$file");
                $this->removed_files++;
            }
        }
        if ($level > 0) {
            rmdir($dir);
            $this->removed_directories++;
        }
    }

    private function scanInput(string $dir, array $arr): array {
        $prefix = strlen(dirname($this->input_dir)) + 1;
        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            $rel_path = substr($path, $prefix);
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
        $prefix = strlen(dirname($this->input_dir)) + 1;
        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        $toctree = [];
        $file_list = [];
        foreach ($files as $ford) {
            $path = $dir . DIRECTORY_SEPARATOR . $ford;
            $rel_path = substr($path, $prefix);
            if (!in_array($rel_path, $this->excludes)) {
                if (is_dir($path)) {
                    if (str_starts_with($path, $this->input_dir)) {
                        $toctree[] = $ford;
                    }
                } elseif (is_file($path)) {
                    if (str_ends_with($path, ".php")) {
                        $file_list[] = basename($path, ".php");
                    }
                }
            }
        }
        $inBetween = DIRECTORY_SEPARATOR . substr($dir, $prefix);
        if ($inBetween == DIRECTORY_SEPARATOR) $inBetween = "";
        $workdir = $this->output_dir . $inBetween;
        $filename = $workdir . DIRECTORY_SEPARATOR . $heading . ".rst";
        echo "................. level " . $level . PHP_EOL;
        echo "scanned directory: " . $dir . PHP_EOL;
        $this->makeNode($heading, $toctree, $file_list, $workdir);
        foreach ($toctree as $ford) {
            $path = $dir . DIRECTORY_SEPARATOR . $ford;
            $this->makeTree($ford, $path, $level);
        }
        foreach ($file_list as $ford) {
            $path = $dir . DIRECTORY_SEPARATOR . $ford;
            $this->makeDocument($ford, $path, $workdir);
        }
    }

    private function makeNode(string $heading, array $toctree, array $file_list, string $workdir): void {
        $s = $heading . PHP_EOL
            . str_repeat("=", strlen($heading)) . PHP_EOL
            . PHP_EOL
            . ".. toctree::" . PHP_EOL . PHP_EOL;
        foreach ($toctree as $line) {
            $s .= "    $line/$line" . PHP_EOL;
            $make_dir = $workdir . DIRECTORY_SEPARATOR . $line;
            mkdir($make_dir, 0777);
            echo "created directory: " . $make_dir . PHP_EOL;
            $this->directories_created++;
        }
        foreach ($file_list as $line) {
            $s .= "    $line/$line" . PHP_EOL;
            $make_dir = $workdir . DIRECTORY_SEPARATOR . $line;
            mkdir($make_dir, 0777);
            echo "created directory: " . $make_dir . PHP_EOL;
            $this->directories_created++;
        }
        $filename = $workdir . DIRECTORY_SEPARATOR . $heading . ".rst";
        file_put_contents($filename, $s);
        echo "created file     : " . $filename . PHP_EOL;
        $this->files_created++;
    }

    private function makeDocument(string $ford, string $path, string $workdir): void {
        $s = $ford . PHP_EOL
            . str_repeat("=", strlen($ford)) . PHP_EOL
            . PHP_EOL
            . "hello " . $ford .PHP_EOL;
        $filename = $workdir . DIRECTORY_SEPARATOR . $ford . DIRECTORY_SEPARATOR . $ford. ".rst";
        file_put_contents($filename, $s);
        echo "created file     : " . $filename . PHP_EOL;
        $this->files_created++;
    }
}