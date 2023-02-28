<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\process\CommentLexer;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class CommentLexerTest extends TestCase {

    public function testMakeStrongParts() {
        $result = CommentLexer::makeStrongParts(["Gets the", "{@link BarClass}", "out of the Foo"]);
        assertEquals(["**Gets the**", "{@link BarClass}", "**out of the Foo**"], $result);
    }

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

    public function testExplodeOnTags() {
        $line = "Gets the {@link BarClass} out of the {@link Foo::method}";
        $result = CommentLexer::explodeOnTags($line);
        $expected = ["Gets the ", "{@link BarClass}", " out of the ", "{@link Foo::method}"];
        assertEquals($expected, $result);
        $line = "Gets the {@link BarClass} out of the {@link Foo::method}.";
        $result = CommentLexer::explodeOnTags($line);
        $expected = ["Gets the ", "{@link BarClass}", " out of the ", "{@link Foo::method}", "."];
        assertEquals($expected, $result);
        $line = "Gets the {@link BarClass}. And out of the {@link Foo::method} this string.";
        $result = CommentLexer::explodeOnTags($line);
        $expected = ["Gets the ", "{@link BarClass}", ". And out of the ", "{@link Foo::method}", " this string."];
        assertEquals($expected, $result);
        $line = "Gets the {@link BarClass description of Bar}. And out of the {@link Foo::method} this string.";
        $result = CommentLexer::explodeOnTags($line);
        $expected = ["Gets the ", "{@link BarClass description of Bar}", ". And out of the ", "{@link Foo::method}",
            " this string."];
        assertEquals($expected, $result);
    }

    public function testExplodeOnTagsLineStartsWithTag() {
        $line = "{@link https://example.com this is the description}. Other inline tags {@other foo}";
        $result = CommentLexer::explodeOnTags($line);
        $expected = ["{@link https://example.com this is the description}", ". Other inline tags ", "{@other foo}"];
        assertEquals($expected, $result);
    }
}
