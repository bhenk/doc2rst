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

$license_to = __DIR__ . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR . "LICENSE";
if (!is_file($license_to)) {
    $license_from = __DIR__ . DIRECTORY_SEPARATOR . "LICENSE";
    copy($license_from, $license_to);
}


try {
    $pharFile = 'doc2rst.phar';
    if (file_exists($pharFile)) {
        unlink($pharFile);
    }
    if (file_exists($pharFile . '.gz')) {
        unlink($pharFile . '.gz');
    }
    $phar = new Phar($pharFile);
    // start buffering. Mandatory to modify stub to add shebang
    $phar->startBuffering();
    // Create the default stub from main.php entrypoint
    $defaultStub = $phar->createDefaultStub('main.php');
    // Add the rest of the apps files
    $phar->buildFromDirectory(__DIR__ . '/application', '{bhenk|Psr|main.php|LICENSE}');

    // Customize the stub to add the shebang
    $stub = "#!/usr/bin/env php \n" . $defaultStub;
    // Add the stub
    $phar->setStub($stub);
    $phar->stopBuffering();
    // plus - compressing it into gzip
    $phar->compressFiles(Phar::GZ);
    # Make the file executable
    chmod(__DIR__ . "/{$pharFile}", 0770);
    echo "$pharFile successfully created" . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
}
