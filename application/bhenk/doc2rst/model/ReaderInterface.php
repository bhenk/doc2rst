<?php

namespace bhenk\doc2rst\model;

use ReflectionClass;

interface ReaderInterface {

    public function render(ReflectionClass $rc): string;

}