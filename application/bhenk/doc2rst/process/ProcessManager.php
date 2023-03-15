<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\D2R;
use bhenk\doc2rst\globals\DocState;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\log\Log;
use function array_keys;
use function file_exists;
use function file_put_contents;
use function fwrite;
use function in_array;
use function unlink;
use function var_export;

/**
 * Runs the transformation of source files to restructured text files.
 */
class ProcessManager {

    private ConstitutionInterface $constitution;

    /**
     * Constructs a new ProcessManager
     *
     * The parameter :term:`doc_root` is the absolute path to the documentation directory.
     *
     * @see bhenk\doc2rst\globals\RC RC for runtime configuration options
     *
     * @param string $doc_root The documentation directory; autoconfiguration is computed from this directory.
     */
    function __construct(private readonly string $doc_root) {}

    /**
     * Quickstart doc2rst
     *
     * This function will scan the source directory known as :term:`vendor_directory`.
     * It will not generate rst-files, only suggest reasonable configuration options for
     * file and directory paths.
     * Furthermore, it will place configuration files in the :term:`doc_root` directory.
     * These configuration files are:
     *
     * * :term:`d2r-conf.php` - run configuration
     * * :term:`d2r-order.php` - order of DocComment segments and tag display
     * * :term:`d2r-styles.txt` - some extra css-styles used by doc2rst
     *
     * @return void
     */
    public function quickStart(): void {
        $this->getConstitution()->establishConfiguration();
        $runConfig = RunConfiguration::toString();
        if (RunConfiguration::getLogLevel() > 200) RunConfiguration::setLogLevel(200);
        Log::notice("started doc2rst in mode [not 4 real]", false);
        Log::info(PHP_EOL . $runConfig, false);
        fwrite(STDOUT, " " . PHP_EOL);

        $sourceScout = new SourceScout();
        $sourceScout->scanSource();
        Log::info("Scanned " . SourceState::countDirectories() . " directories and "
            . SourceState::countFiles() . " files in " . RunConfiguration::getVendorDirectory(), false);

        // configuration
        $configuration_file = RunConfiguration::getDocRoot()
            . DIRECTORY_SEPARATOR . D2R::CONFIGURATION_FILENAME;
        if (!file_exists($configuration_file)) {
            $contents = "<?php" . PHP_EOL . PHP_EOL
                . "return " . var_export(RunConfiguration::toArray(), true) . ";";
            file_put_contents($configuration_file, $contents);
            Log::notice("Created configuration file at file://" . $configuration_file, false);
        }

        // styles
        $styles_file = RunConfiguration::getDocRoot()
            . DIRECTORY_SEPARATOR . D2R::STYLES_FILENAME;
        if (!file_exists($styles_file)) {
            $contents = D2R::getStyles();
            file_put_contents($styles_file, $contents);
            Log::notice("Created styles file at file://" . $styles_file, false);
        }

        // order
        $order_file = RunConfiguration::getDocRoot()
            . DIRECTORY_SEPARATOR . D2R::COMMENT_ORDER_FILENAME;
        if (!file_exists($order_file)) {
            $contents = D2R::getCommentOrderContents();
            file_put_contents($order_file, $contents);
            Log::notice("Created comment order file at file://" . $order_file, false);
        }

        Log::notice("If the above information is correct,"
            . " you can run ProcessManager->run();"
            . PHP_EOL
            . "Otherwise set more specific configuration in configuration file "
            . D2R::CONFIGURATION_FILENAME, false);
    }

    /**
     * Run doc2rst and generate rst-files.
     *
     * If nothing goes wrong you will find api-documentation in the :term:`api_directory` folder under
     * your :term:`doc_root` directory.
     *
     * @see bhenk\doc2rst\globals\RC RC for runtime configuration options
     * @return void
     */
    public function run(): void {
        $this->getConstitution()->establishConfiguration();
        Log::notice("Started doc2rst in mode [4 real]", false);
        Log::debug(PHP_EOL . RunConfiguration::toString());

        $sourceScout = new SourceScout();
        $sourceScout->scanSource();
        Log::info("Scanned " . SourceState::countDirectories() . " directories and "
            . SourceState::countFiles() . " files in " . RunConfiguration::getVendorDirectory(), false);

        $docScout = new DocScout();
        $docScout->scanDocs();
        DocState::setPreRun(false);

        $treeWorker = new TreeWorker();
        $treeWorker->walkTree();

        $files_removed = 0;
        $new_keys = array_keys(DocState::getPostRunFiles());
        foreach (DocState::getPreRunFiles() as $old_file => $checksum) {
            if (!in_array($old_file, $new_keys)) {
                unlink($old_file);
                $files_removed++;
            }
        }
        $dirs_removed = 0;
        foreach (DocState::getPreRunDirs() as $old_dir) {
            if (!in_array($old_dir, DocState::getPostRunDirs())) {
                rmdir($old_dir);
                $dirs_removed++;
            }
        }

        $files_unchanged = 0;
        $files_changed = 0;
        $files_new = 0;
        $old_keys = array_keys(DocState::getPreRunFiles());
        foreach (DocState::getPostRunFiles() as $new_file => $checksum) {
            if (in_array($new_file, $old_keys)) {
                if ($checksum == DocState::getPreRunFiles()[$new_file]) {
                    $files_unchanged++;
                } else {
                    $files_changed++;
                }
            } else {
                $files_new++;
            }
        }
        Log::info("Finished doc2rst. Changes in api-directory " . RunConfiguration::getApiDirectory() . ":" . PHP_EOL
            . "         files removed: " . $files_removed . PHP_EOL
            . "         dirs removed : " . $dirs_removed . PHP_EOL
            . "         new files    : " . $files_new . PHP_EOL
            . "         changed files: " . $files_changed . PHP_EOL
            . "         unchanged    : " . $files_unchanged
            , false);
    }

    /**
     * Autoconfiguration is done by an implementation of {@link ConstitutionInterface}.
     *
     * At the moment
     * there is only one implementation: {@link Constitution}. If necessary write your own Constitution!
     *
     * @return ConstitutionInterface
     */
    public function getConstitution(): ConstitutionInterface {
        if (!isset($this->constitution)) {
            $this->constitution = new Constitution($this->doc_root);
        }
        return $this->constitution;
    }

    /**
     * Sets the Constitution used for autoconfiguration.
     *
     * @param ConstitutionInterface $constitution
     */
    public function setConstitution(ConstitutionInterface $constitution): void {
        $this->constitution = $constitution;
    }


}