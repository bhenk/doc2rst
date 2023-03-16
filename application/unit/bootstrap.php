<?php

namespace unit;

/**
 * Running phpunit in CLI (from project root):
 * $ phpunit --bootstrap application/unit/bootstrap.php application/unit
 *
 * Running phpunit from phpStorm:
 * make sure this file is set in settings>PHP>Test Frameworks,
 * 'Default bootstrap file' (under Test Runner).
 */
$vendor_autoload = dirname(__DIR__, 2)
    . DIRECTORY_SEPARATOR . "vendor"
    . DIRECTORY_SEPARATOR . "autoload.php";

require_once $vendor_autoload;

date_default_timezone_set('Europe/Amsterdam');
