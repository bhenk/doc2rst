<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\Constitution;
use bhenk\doc2rst\globals\ConstitutionInterface;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\log\Log;

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

    public function testRun(): void {
        $this->getConstitution()->establishConfiguration();
        $runConfig = RunConfiguration::toString();
        if (RunConfiguration::getLogLevel() > 200) RunConfiguration::setLogLevel(200);
        Log::notice("started doc2rst in mode [not 4 real]");
        Log::info(PHP_EOL . $runConfig);

        $sourceScout = new SourceScout();
        $sourceScout->scanSource();
        Log::info("Scanned " . SourceState::countDirectories() . " directories and "
            . SourceState::countFiles() . " files in " . RunConfiguration::getVendorDirectory());

        Log::notice(PHP_EOL . "If the above information is correct,"
            . "you can run ProcessManager->run();"
            . PHP_EOL
            . "Otherwise set more specific configuration in conf.php" . PHP_EOL);
    }

    public function run(): void {
        $this->getConstitution()->establishConfiguration();
        Log::notice("Started doc2rst in mode [4 real]");
        Log::debug(PHP_EOL . RunConfiguration::toString());

        $sourceScout = new SourceScout();
        $sourceScout->scanSource();
        Log::info("Scanned " . SourceState::countDirectories() . " directories and "
            . SourceState::countFiles() . " files in " . RunConfiguration::getApplicationRoot());

        //var_dump(SourceState::getFileOrder());
        //$sourceScout->makeTocFiles(FileTypes::PHP);
        $docWorker = new TreeWorker();
        $docWorker->makeDocs();
    }

}