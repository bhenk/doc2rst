<?php

namespace unit\doc2rst\tag;

use bhenk\doc2rst\conf\Config;
use bhenk\doc2rst\tag\LinkTag;
use bhenk\doc2rst\work\DocManager;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class LinkTagTest extends TestCase {

    public function setUp(): void {
        $docManager = new DocManager();
        Config::load([], $docManager);
        parent::setUp();
    }

    public function testRender(): void {
        $lt = new LinkTag();
        $s = $lt->render("{@link Attribute::TARGET_CLASS}");
        assertEquals("`Attribute <https://www.php.net/manual/en/class.attribute.php>`_", $s);

        $s = $lt->render("{@link OutOfBoundsException::getMessage()}"); // ==> 404
        $s = $lt->render("{@link ReflectionClass::getFileName}"); // ==> ReflectionClass
        $s = $lt->render("{@link ReflectionClass::getFileName()}");
        assertEquals("`ReflectionClass <https://www.php.net/manual/en/reflectionclass.getfilename.php>`_", $s);

        $s = $lt->render("{@link Attribute::TARGET_CLASS Attribute::TARGET_CLASS}");
        assertEquals("`Attribute::TARGET_CLASS <https://www.php.net/manual/en/class.attribute.php>`_", $s);

        $s = $lt->render("@see Attribute::TARGET_METHOD Attribute::TARGET_METHOD");
        assertEquals("`Attribute::TARGET_METHOD <https://www.php.net/manual/en/class.attribute.php>`_", $s);
        //echo "--$s--" . PHP_EOL;
    }
}
