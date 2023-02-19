<?php

namespace bhenk\doc2rst\work;

use ReflectionClass;

interface ClassHeadReaderInterface {

    public function makeClassHead(ReflectionClass $rc): string;

}