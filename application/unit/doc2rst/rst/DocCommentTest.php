<?php

namespace unit\doc2rst\rst;

use bhenk\doc2rst\rst\DocComment;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class DocCommentTest extends TestCase {

    public function testToString() {
        $dc = new DocComment();
        $dc->addDescription("**first part**");
        $dc->addDescription("special");
        $dc->addDescription("**second part**");

        assertEquals("**first part** special **second part**" . PHP_EOL . PHP_EOL . PHP_EOL,
            $dc->__toString());

        $dc->addLine("line 1");
        $dc->addLine("line 2");

        $dc->addSee("https://linking.com");

        $dc->addParam("\$name (string) - description");
        $dc->addParam("\$name (string) - description");
        $dc->setReturn("(int) - count of lines");
        //echo $dc;
    }
}
