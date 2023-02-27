<?php

namespace unit\doc2rst\tag;

use bhenk\doc2rst\tag\AuthorTag;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class AuthorTagTest extends TestCase {

    public function testGetName() {
        $tag = new AuthorTag("@author Dylan Thomas dt@dot.net");
        $expected = "Dylan Thomas";
        assertEquals($expected, $tag->getName());

        $tag = new AuthorTag("@author Dylan Thomas");
        assertEquals($expected, $tag->getName());
    }

    public function testGetEmail() {
        $tag = new AuthorTag("@author Dylan Thomas dt@dot.net");
        $expected = "dt@dot.net";
        assertEquals($expected, $tag->getEmail());

        $tag = new AuthorTag("@author dt@dot.net");
        assertEquals($expected, $tag->getEmail());
    }
}
