<?php

$psr = __DIR__ . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR . "Psr";
if (!is_dir($psr)) {
    $container = $psr. DIRECTORY_SEPARATOR . "Container";
    mkdir($container, 0777, true);
    $psr_vendor = __DIR__ . DIRECTORY_SEPARATOR . "vendor/psr/container";
    copy($psr_vendor. "/LICENSE", $container . "/LICENSE");
    copy($psr_vendor. "/src/ContainerExceptionInterface.php", $container . "/ContainerExceptionInterface.php");
    copy($psr_vendor. "/src/ContainerInterface.php", $container . "/ContainerInterface.php");
    copy($psr_vendor. "/src/NotFoundExceptionInterface.php", $container . "/NotFoundExceptionInterface.php");
}

$license_from = __DIR__ . DIRECTORY_SEPARATOR . "LICENSE";
$license_to = __DIR__ . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR . "LICENSE";
copy($license_from, $license_to);

$readme_from = __DIR__ . DIRECTORY_SEPARATOR . "README.md";
$readme_to = __DIR__ . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR . "README.md";
copy($readme_from, $readme_to);


try {
    $pharFile = 'doc2rst.phar';
    if (file_exists($pharFile)) {
        unlink($pharFile);
    }
    if (file_exists($pharFile . '.gz')) {
        unlink($pharFile . '.gz');
    }
    $phar = new Phar($pharFile);
    $phar->startBuffering();
    $defaultStub = $phar->createDefaultStub('main.php');
    $phar->buildFromDirectory(__DIR__ . '/application', '{bhenk|Psr|main.php|LICENSE|README.md}');
    $stub = "#!/usr/bin/env php \n" . $defaultStub;
    $phar->setStub($stub);
    $phar->stopBuffering();

    $phar->compressFiles(Phar::GZ);
    chmod(__DIR__ . "/{$pharFile}", 0770);
    echo "$pharFile successfully created" . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}
exit(0);
