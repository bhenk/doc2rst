<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\log\Log;
use function file_exists;
use function file_put_contents;
use function fwrite;
use function var_export;

class ProcessManager {

    private ConstitutionInterface $constitution;

    function __construct(private readonly string $doc_root) {}

    /**
     * @return ConstitutionInterface
     */
    public function getConstitution(): ConstitutionInterface {
        if (!isset($this->constitution)) {
            $this->constitution = new Constitution($this->doc_root);
        }
        return $this->constitution;
    }

    /**
     * @param ConstitutionInterface $constitution
     */
    public function setConstitution(ConstitutionInterface $constitution): void {
        $this->constitution = $constitution;
    }

    public function quickStart(): void {
        $this->getConstitution()->establishConfiguration();
        $runConfig = RunConfiguration::toString();
        if (RunConfiguration::getLogLevel() > 200) RunConfiguration::setLogLevel(200);
        Log::notice("started doc2rst in mode [not 4 real]");
        Log::info(PHP_EOL . $runConfig);
        fwrite(STDOUT, " " . PHP_EOL);

        $sourceScout = new SourceScout();
        $sourceScout->scanSource();
        Log::info("Scanned " . SourceState::countDirectories() . " directories and "
            . SourceState::countFiles() . " files in " . RunConfiguration::getVendorDirectory());

        $configuration_file = RunConfiguration::getDocRoot() . DIRECTORY_SEPARATOR . "conf.php";
        if (!file_exists($configuration_file)) {
            $contents = "<?php" . PHP_EOL . PHP_EOL
                . "return " . var_export(RunConfiguration::toArray(), true) . ";";
            file_put_contents($configuration_file, $contents);
            Log::notice("Created configuration file at file://" . $configuration_file);
        }

        Log::notice("If the above information is correct,"
            . " you can run ProcessManager->run();"
            . PHP_EOL
            . "Otherwise set more specific configuration in configuration file conf.php");
    }

    public function run(): void {
        $this->getConstitution()->establishConfiguration();
        Log::notice("Started doc2rst in mode [4 real]");
        Log::debug(PHP_EOL . RunConfiguration::toString());

        $sourceScout = new SourceScout();
        $sourceScout->scanSource();
        Log::info("Scanned " . SourceState::countDirectories() . " directories and "
            . SourceState::countFiles() . " files in " . RunConfiguration::getVendorDirectory());

        $treeWorker = new TreeWorker();
        $treeWorker->makeDocs();
    }

}