<?php

namespace bhenk\doc2rst\work;

interface PhpClassReaderInterface {

    public function makeDocument(string $namespace, string $classname): string;

}