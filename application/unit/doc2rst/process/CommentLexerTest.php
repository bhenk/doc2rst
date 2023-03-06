<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\process\CommentLexer;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class CommentLexerTest extends TestCase {

    public function testPreserveMarkup() {
        $line = "**Preserves italic *null* and ticks ``true`` markup**";
        $result = CommentLexer::preserveMarkup($line);
        $expected = "**Preserves italic** *null* **and ticks** ``true`` **markup**";
        assertEquals($expected, $result);

        $line = "**Preserves italic *null* and ticks ``true`` markup, even on last *word***";
        $result = CommentLexer::preserveMarkup($line);
        $expected = "**Preserves italic** *null* **and ticks** ``true`` **markup, even on last** *word*";
        assertEquals($expected, $result);

        $line = "**Preserves italic *null* and ticks ``true`` markup, even on last ``word``**";
        $result = CommentLexer::preserveMarkup($line);
        $expected = "**Preserves italic** *null* **and ticks** ``true`` **markup, even on last** ``word``";
        assertEquals($expected, $result);
    }

    public function testPreserveMarkupOnFirstWords() {
        $line = "**``manywords`` word ``quoted``**";
        $result = CommentLexer::preserveMarkup($line);
        $expected = "``manywords`` **word** ``quoted``";
        assertEquals($expected, $result);

        $line = "***oneword* word ``quoted``**";
        $result = CommentLexer::preserveMarkup($line);
        $expected = "*oneword* **word** ``quoted``";
        assertEquals($expected, $result);
    }

}
