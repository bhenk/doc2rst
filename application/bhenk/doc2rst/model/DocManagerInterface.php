<?php

namespace bhenk\doc2rst\model;

use ReflectionClass;

interface DocManagerInterface {

    public function work(): void;

    public function setScannedDocuments(array $scanned): void;

    public function getScannedDocuments(): array;

    public function makeDocument(string $classname, string $path, string $workdir): void;

    public function setCurrentClass(ReflectionClass $currentClass): void;

    public function getCurrentClass(): ReflectionClass;

}