<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\process\CommentLexer;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class CommentLexerTest extends TestCase {

    public function testSplitLine() {
        //$arr = CommentLexer::splitLine("foo bar", []);
        $arr = CommentLexer::splitLine("foo{@link baz}bar{@see doo}had", []);
        //var_dump($arr);
        assertEquals(1, 1);
    }
}
