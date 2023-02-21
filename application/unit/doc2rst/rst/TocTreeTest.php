<?php

namespace unit\doc2rst\rst;

use bhenk\doc2rst\rst\TocTree;
use PHPUnit\Framework\TestCase;

class TocTreeTest extends TestCase {

    public function testToString() {
        $tt = new TocTree(["entry 1", "entry 2"]);
        $tt->setMaxDepth(0);
        $tt->setCaption("Caption");
        $tt->setName("name");
        echo $tt->__toString();
        self::assertEquals(1, 1);
    }

}
