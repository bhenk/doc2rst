<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\work\PhpParser;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use function count;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertStringContainsString;
use function PHPUnit\Framework\assertTrue;

final class PhpParserTest extends TestCase {

    /**
     * This is a test constant.
     *
     * It is used for testing.
     */
    const TEST_01 = "test 01";

    /**
     * astray doc comment.
     *
     * This comment does not belong to anything.
     */

    /** A property just for testing */
    private string $testing_property = "has a value";

    public function test__construct() {
        $this->expectException(RuntimeException::class);
        $pp = new PhpParser();
        $pp->hasInlineHtml();
    }

    public function testNamespace() {
        $pp = new PhpParser();
        $pp->parseString("<?php ");
        assertNull($pp->getNamespace());
        //if ($pp->getClass()) self::fail("no class expected");
    }

    /**
     * Summary for testSelf.
     *
     * description of testSelf
     *
     * @return void
     */
    public function testSelf(): void {
        $pp = new PhpParser();
        $pp->parseFile(__FILE__);
        assertEquals(3, $pp->getNamespace()->getLine());
        assertEquals("unit\doc2rst\process", $pp->getNamespace()->getValue());
        assertEquals("bhenk\doc2rst\work\PhpParser", $pp->getUses()[0]->getValue());
        assertEquals("PhpParserTest", $pp->getClass()->getValue());
        $class_name = "";
        if ($pp->getClass()) $class_name = $pp->getClass()->getValue();
        assertEquals("PhpParserTest", $class_name);

        assertEquals(null, $pp->getConstants()["TEST_01"]->getValue());
        assertStringContainsString("It is used for testing.", $pp->getConstants()["TEST_01"]->getDocComment());
        assertTrue(($pp->getConstants()["TEST_01"]->getDocCommentEnd() + 1) == $pp->getConstants()["TEST_01"]->getLine());
        assertEquals(1, $pp->getConstants()["TEST_01"]->getDocCommentDistance());

        assertEquals(-1, $pp->getFunctions()["testNamespace"]->getDocCommentDistance());
        assertEquals(-1, $pp->getFunctions()["testNamespace"]->getDocCommentStart());
        assertEquals(-1, $pp->getFunctions()["testNamespace"]->getDocCommentEnd());
        assertNull($pp->getFunctions()["testNamespace"]->getDocComment());

        assertEquals(null, $pp->getFunctions()["testSelf"]->getValue());

        assertEquals(null, $pp->getVariables()["\$testing_property"]->getValue());
        assertEquals("/** A property just for testing */", $pp->getVariables()["\$testing_property"]->getDocComment());
        assertEquals(1, $pp->getVariables()["\$testing_property"]->getDocCommentDistance());

        assertTrue($pp->isClassFile());
        assertFalse($pp->isInterfaceFile());
        assertFalse($pp->isTraitFile());
        assertFalse($pp->isEnumFile());
    }

    public function testPhpFile() {
        $pp = new PhpParser();
        $pp->parseFile(__DIR__ . DIRECTORY_SEPARATOR . "parser-test.php");

        assertTrue($pp->isInitialized());
        assertTrue($pp->isPhp());
        assertFalse($pp->hasInlineHtml());
        assertFalse($pp->isClassFile());
        assertFalse($pp->isInterfaceFile());
        assertFalse($pp->isTraitFile());
        assertFalse($pp->isEnumFile());
        assertEquals("unit\doc2rst\process", $pp->getNamespace()->getValue());
        assertEquals("/** recommended to have a namespace */", $pp->getNamespace()->getDocComment());

        assertEquals(2, count($pp->getConstants()));
        $struct = $pp->getConstants()["CONSTANT_01"];
        assertStringContainsString("multiple line comment", $struct->getDocComment());
        assertEquals(1, $struct->getDocCommentDistance());
        assertNull($pp->getConstants()["CONSTANT_02"]->getDocComment());

        assertEquals(2, count($pp->getVariables()));
        $struct = $pp->getVariables()["\$prop_01"];
        assertNull($struct->getDocComment());
        $struct = $pp->getVariables()["\$prop_02"];
        assertEquals("/** used for testing one-line comments */", $struct->getDocComment());

        assertEquals(2, count($pp->getFunctions()));
        $struct = $pp->getFunctions()["getFoo"];
        assertStringContainsString("Gets some Foo", $struct->getDocComment());
        $struct = $pp->getFunctions()["getBar"];
        assertNull($struct->getDocComment());
    }

}
