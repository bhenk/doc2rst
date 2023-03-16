<?php

use bhenk\doc2rst\process\ProcessManager;

function help(): void {
    echo PHP_EOL
        . "doc2rst: Generate reStructuredText from PHPDocs" . PHP_EOL
        . "===============================================" . PHP_EOL
        . "Usage: doc2rst [options] [args]" . PHP_EOL . PHP_EOL
        . "Options:" . PHP_EOL
        . "   -h, h, -help, help:" . PHP_EOL
        . "         Print this help message" . PHP_EOL
        . "   -q, q, -quickstart, quickstart:" . PHP_EOL
        . "         Quickstart doc2rst. Does reasonable guesses for configuration options." . PHP_EOL
        . "          Scans source folder. Does *not* generate .rst-files." . PHP_EOL
        . "          Saves missing configuration files in doc_root." . PHP_EOL
        . "   -r, r, -run run:" . PHP_EOL
        . "         Runs doc2rst. Uses d2r-conf.php in doc_root as run configuration. If no" . PHP_EOL
        . "          configuration file found, uses reasonable guesses and default settings." . PHP_EOL . PHP_EOL
        . "Args:" . PHP_EOL
        . "   doc_root:" . PHP_EOL
        . "         Absolute or relative path to documentation folder. Default: 'docs'" . PHP_EOL . PHP_EOL
    ;
}

/**
 * Autoload our own classes.
 * Classes can be in phar or on file system.
 */
spl_autoload_register(function ($para) {
    $path = __DIR__ . DIRECTORY_SEPARATOR
        . str_replace('\\', DIRECTORY_SEPARATOR, $para) . '.php';
    if (file_exists($path)) {
        include $path;
        return true;
    }
    return false;
});

$root = substr(dirname(__DIR__), 0);
if (str_starts_with($root, "phar://")) $root = substr($root, 7);
echo "Running doc2rst from " . $root . PHP_EOL;

$option = $argv[1] ?? null;
$doc_root = $argv[2] ?? null;

if (is_null($doc_root)) {
    if (is_dir($root . DIRECTORY_SEPARATOR . "docs")) {
        // starting from project root
        $doc_root = $root . DIRECTORY_SEPARATOR . "docs";
    } elseif (basename($root) == "docs") {
        // starting from doc_root
        $doc_root = $root;
    } else {
        echo "No doc_root found and no doc_root in arguments" . PHP_EOL;
        help();
        exit(1);
    }
} elseif (!realpath($doc_root) or !is_dir($doc_root)) {
    $doc_root = $root . DIRECTORY_SEPARATOR . $doc_root;
    if (!realpath($doc_root) or !is_dir($doc_root)) {
        echo "File not found or not a directory, doc_root: " . $doc_root . PHP_EOL;
        help();
        exit(1);
    }
}
$doc_root = realpath($doc_root);

if (!is_null($option) and (str_starts_with($option, "h") or str_starts_with($option, "-h"))) {
    help();
    exit(0);
}

$process = new ProcessManager($doc_root, $root);

if (!is_null($option) and (str_starts_with($option, "q") or str_starts_with($option, "-q"))) {
    $process->quickStart();
    exit(0);
}

if (is_null($option) or str_starts_with($option, "r") or str_starts_with($option, "-r")) {
    $process->run();
    exit(0);
}

help();
exit(0);

