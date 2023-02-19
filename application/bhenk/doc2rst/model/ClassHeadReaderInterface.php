<?php

namespace bhenk\doc2rst\model;

use ReflectionClass;

interface ClassHeadReaderInterface {

    public function makeClassHead(ReflectionClass $rc): string;

}