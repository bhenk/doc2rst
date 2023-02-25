<?php

namespace bhenk\doc2rst\globals;

use bhenk\doc2rst\log\Log;
use Exception;
use Throwable;
use function array_diff;
use function dirname;
use function fwrite;
use function in_array;
use function is_dir;
use function is_file;
use function is_null;
use function realpath;
use function scandir;

class Constitution implements ConstitutionInterface {

    private static array $maybe_application_root = [
        "application",
        "src",
    ];

    private static array $not_source = [
        "log",
        "logs",
        "unit",
        "test",
        "tests",
        "conf",
        "config",
        "configuration",
        "store",
        "stores",
        "zzz",
        "vendor",
        "doc",
        "docs",
    ];

    /**
     * Constructs a new {@link Constitution}
     *
     * @param string $doc_root the root-folder for documentation
     */
    function __construct(private readonly string $doc_root) {}

    /**
     * @inheritdoc
     *
     * @return void
     */
    public function establishConfiguration(): void {
        $this->initialize();
    }

    private function initialize(): void {
        try {
            $this->loadConfiguration();
        } catch (Throwable $e) {
            $s = "\e[91mFatal error while loading run configuration: " . $e->getMessage()
                . PHP_EOL
                . $e->getTraceAsString()
                . PHP_EOL
                . "\e[0m";
            fwrite(STDERR, $s);
            exit(1);
        }
        try {
            $this->setRunConfiguration();
        } catch (Throwable $e) {
            $s = "\e[91mFatal error while setting run configuration: " . $e->getMessage()
                . PHP_EOL
                . $e->getTraceAsString()
                . PHP_EOL
                . "\e[0m";
            fwrite(STDERR, $s);
            exit(1);
        }
    }

    private function loadConfiguration(): void {
        $conf = $this->doc_root . DIRECTORY_SEPARATOR . "conf.php";
        if (!is_file($conf)) {
            Log::info("No configuration file found at " . $conf);
        } else {
            $configuration = require_once $conf;
            RunConfiguration::load($configuration);
            Log::info("Loaded configuration from " . $conf);
        }
    }

    private function setRunConfiguration(): void {
        // doc root must be set: we write in it.
        $doc_root = RunConfiguration::getDocRoot() ?? $this->doc_root;
        if (is_null($doc_root) or !is_dir($doc_root)) {
            throw new Exception("not set or not a directory "
                . RC::doc_root->name . ": " . $doc_root);
        }
        RunConfiguration::setDocRoot($doc_root);

        // application root
        $application_root = RunConfiguration::getApplicationRoot();
        if (is_null($application_root)) {
            $application_root = self::autoFindApplicationRoot($doc_root);
        }
        if (is_null($application_root) or !is_dir($application_root)) {
            throw new Exception("not set or not a directory "
                . RC::application_root->name . ": " . $application_root);
        }
        RunConfiguration::setApplicationRoot($application_root);

        // source directory
        $vendor_directory = RunConfiguration::getVendorDirectory();
        if (is_null($vendor_directory)) {
            $vendor_directory = self::autoFindSource($application_root);
        }
        if (is_null($vendor_directory) or !is_dir($vendor_directory)) {
            throw new Exception("not set or not a directory "
                . RC::vendor_directory->name . ": " . $vendor_directory);
        }
        RunConfiguration::setVendorDirectory($vendor_directory);

        // api directory
        $api_directory = RunConfiguration::getApiDirectory();
        if (is_null($api_directory)) {
            $api_directory = $doc_root . DIRECTORY_SEPARATOR . "api";
        }
        RunConfiguration::setApiDirectory($api_directory);

        // api docs title
        $api_docs_title = RunConfiguration::getApiDocsTitle();
        if (empty($api_docs_title)) RunConfiguration::setApiDocsTitle("api-docs");
    }


    public static function autoFindApplicationRoot(string $doc_root): ?string {
        $project_root = dirname($doc_root);
        foreach (self::$maybe_application_root as $name) {
            $application_root = $project_root . DIRECTORY_SEPARATOR . $name;
            if (is_dir($application_root)) {
                return realpath($application_root);
            }
        }
        return null;
    }

    public static function autoFindSource(string $application_root): ?string {
        $files = array_diff(scandir($application_root, SCANDIR_SORT_DESCENDING),
            array("..", ".", ".DS_Store"));
        foreach ($files as $basename) {
            $filename = $application_root . DIRECTORY_SEPARATOR . $basename;
            if (is_dir($filename)) {
                if (!in_array($basename, self::$not_source)) {
                    return realpath($application_root . DIRECTORY_SEPARATOR . $basename);
                }
            }
        }
        return null;
    }
}