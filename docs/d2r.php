<?php

use bhenk\doc2rst\process\ProcessManager;

$vendor_autoload = dirname(__DIR__)
    . DIRECTORY_SEPARATOR
    . "vendor"
    . DIRECTORY_SEPARATOR
    . "autoload.php";
if (!is_file($vendor_autoload)) {
    echo "vendor/autoload.php not found" . PHP_EOL;
    echo "tried this path: " . $vendor_autoload;
    exit(1);
}
require_once $vendor_autoload;

$process = new ProcessManager(__DIR__);
$quickstart = $argv[1] ?? null;
if ($quickstart) {
    $process->quickStart();
} else {
    $process->run();

    $output = [];
    exec("make html",$output);
    echo end($output) . PHP_EOL;
}


