<?php

namespace unit\doc2rst\tag;

use bhenk\doc2rst\tag\TagFactory;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class TagFactoryTest extends TestCase {

    public function testExplodeOnTags() {
        $line = "Gets the {@link BarClass} out of the {@link Foo::method}";
        $result = TagFactory::explodeOnTags($line);
        $expected = ["Gets the ", "{@link BarClass}", " out of the ", "{@link Foo::method}"];
        assertEquals($expected, $result);
        $line = "Gets the {@link BarClass} out of the {@link Foo::method}.";
        $result = TagFactory::explodeOnTags($line);
        $expected = ["Gets the ", "{@link BarClass}", " out of the ", "{@link Foo::method}", "."];
        assertEquals($expected, $result);
        $line = "Gets the {@link BarClass}. And out of the {@link Foo::method} this string.";
        $result = TagFactory::explodeOnTags($line);
        $expected = ["Gets the ", "{@link BarClass}", ". And out of the ", "{@link Foo::method}", " this string."];
        assertEquals($expected, $result);
        $line = "Gets the {@link BarClass description of Bar}. And out of the {@link Foo::method} this string.";
        $result = TagFactory::explodeOnTags($line);
        $expected = ["Gets the ", "{@link BarClass description of Bar}", ". And out of the ", "{@link Foo::method}",
            " this string."];
        assertEquals($expected, $result);
    }

    public function testExplodeOnTagsLineStartsWithTag() {
        $line = "{@link https://example.com this is the description}. Other inline tags {@other foo}";
        $result = TagFactory::explodeOnTags($line);
        $expected = ["{@link https://example.com this is the description}", ". Other inline tags ", "{@other foo}"];
        assertEquals($expected, $result);
    }

}
