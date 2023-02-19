<?php

namespace bhenk\doc2rst\conf;

interface DocManagerInterface {

    public function setScannedDocuments(array $scanned): void;

    public function work(): void;

    public function makeDocument(string $classname, string $path, string $workdir): void;

}