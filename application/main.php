<?php

use bhenk\doc2rst\process\ProcessManager;

spl_autoload_register(function ($para) {
    $path = __DIR__ . DIRECTORY_SEPARATOR
        . str_replace('\\', DIRECTORY_SEPARATOR, $para) . '.php';
    if (file_exists($path)) {
        include $path;
        return true;
    }
    return false;
});

$quickstart = $argv[1] ?? null;
$doc_root = $argv[2] ?? null;

$root = substr(dirname(__DIR__), 7);
if (is_null($doc_root)) {
    if (is_dir($root . DIRECTORY_SEPARATOR . "docs")) {
        $doc_root = $root . DIRECTORY_SEPARATOR . "docs";
    } else {
        echo "No doc_root" . PHP_EOL;
        exit(1);
    }
} elseif (realpath($doc_root)) {
    $doc_root = realpath($doc_root);
} else {
    echo "Not a directory: " . $doc_root . PHP_EOL;
    exit(1);
}

$process = new ProcessManager($doc_root);

if (!is_null($quickstart) and str_starts_with($quickstart, "q")) {
    $process->quickStart();
} else {
    $process->run();
}