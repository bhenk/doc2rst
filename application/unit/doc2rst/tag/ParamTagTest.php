<?php

namespace unit\doc2rst\tag;

use bhenk\doc2rst\tag\ParamTag;
use PHPUnit\Framework\TestCase;

class ParamTagTest extends TestCase {

    public function testRender() {
        $pt = new ParamTag("@param string name description");
        self::assertEquals("string :param:`name` - description", $pt->__toString());

//        SourceState::setPhpFiles([str_replace("\\", "/", ParamTag::class) . ".php"]);
//        $pt = new ParamTag("@param ParamTag name description");
//        self::assertEquals(":ref:`bhenk\doc2rst\\tag\ParamTag` :param:`name` - description", $pt->__toString());

//        $pt = new ParamTag("@param QuickHashIntSet name description");
//        self::assertEquals("QuickHashIntSet ``name`` description", $pt->__toString());

//        $pt = new ParamTag("@param ReflectionClass name description");
//        self::assertEquals("`ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ :param:`name` - description", $pt->__toString());

//        $pt = new ParamTag("@param string name");
//        self::assertEquals("string :param:`name`", $pt->__toString());
//        $this->expectException(RuntimeException::class);
//        $pt = new ParamTag("@param");
//        self::assertEquals("", $pt->__toString());

//        self::expectExceptionMessage("Incompatible tag name: @para");
//        $pt = new ParamTag("@para");
    }

}
