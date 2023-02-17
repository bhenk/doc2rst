<?php

namespace bhenk\doc2rst;

interface PhpClassReaderInterface {

    public function makeDocument(string $namespace, string $classname): string;

}