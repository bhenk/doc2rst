<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\conf\Config;
use bhenk\doc2rst\log\Log;
use function is_null;

class DocManager {

    private array $scanned = [];

    public function work(): void {
        $source_dir = Config::get()->getValue("source_directory");
        Log::notice("Starting doc2rst in source directory " . $source_dir);
        (new DirectoryCrawler($this))->makeDocumentTree();
    }

    public function setScannedDocuments(array $scanned) {
        $this->scanned = $scanned;
    }

}