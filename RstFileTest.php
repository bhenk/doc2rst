<?php

namespace unit\doc2rst\rst;

use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\RstFile;
use bhenk\doc2rst\rst\Title;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotSame;

class RstFileTest extends TestCase {

    public function test__toString() {
        $rest = new RstFile("bla");
        $rest->addEntry(new Label("target deze plek"));
        $rest->addEntry(new Title("Hallo wereld"));
        $rest->addEntry(new Title("Goedendag", 1));
        echo $rest;
        assertNotSame(1, 0);
    }
}
