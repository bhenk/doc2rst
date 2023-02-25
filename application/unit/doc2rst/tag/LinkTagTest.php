<?php

namespace unit\doc2rst\tag;

use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\tag\LinkTag;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function str_replace;

class LinkTagTest extends TestCase {

    public function testReference() {
        SourceState::setPhpFiles([str_replace("\\", "/", LinkTag::class) . ".php"]);
        $lt = new LinkTag("@link LinkTag::render() description");
        assertEquals(":ref:`bhenk\doc2rst\\tag\LinkTag::render()`", $lt->__toString());
        assertEquals("LinkTag::render() description", $lt->getLine());
    }

    public function testRenderInlineTag() {
        SourceState::setPhpFiles([str_replace("\\", "/", LinkTag::class) . ".php"]);
        $lt = new LinkTag("{@link LinkTag::render() description}");
        assertEquals(":ref:`bhenk\doc2rst\\tag\LinkTag::render()`", $lt->__toString());
        assertEquals("LinkTag::render() description", $lt->getLine());
    }

}
