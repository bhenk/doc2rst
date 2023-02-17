<?php

namespace bhenk\doc2rst\work;

use ReflectionClass;

interface PhpClassReaderInterface {

    public function makeClassHead(ReflectionClass $rc): string;

}