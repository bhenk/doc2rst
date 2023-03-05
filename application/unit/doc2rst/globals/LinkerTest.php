<?php

namespace unit\doc2rst\globals;

use bhenk\doc2rst\globals\Linker;
use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\TypeLinker;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use function PHPUnit\Framework\assertEquals;

class LinkerTest extends TestCase {

    public function noTest(string $test1, bool $test2): string|bool {
        return false;
    }

    public function testGetLinkNull() {
        assertEquals("", Linker::getLink(null));
    }

    public function testGetDataTypeLink() {
        assertEquals("string", Linker::getLink("string"));
        assertEquals("?\ float", Linker::getLink("?float"));
        assertEquals("null | float | string", Linker::getLink("null|float|string"));
    }

    public function testGetNormalLink() {
        assertEquals("http://example.com", Linker::getLink("http://example.com"));
        assertEquals("`example <http://example.com>`_",
            Linker::getLink("http://example.com", "example"));
    }

    public function testLinkToParameters() {
        $class = new ReflectionClass(self::class);
        $method = new ReflectionMethod(self::class, "noTest");
        ProcessState::setCurrentClass($class);
        ProcessState::setCurrentMethod($method);
        assertEquals(":tagsign:`param`:ref:`\$test1<unit\doc2rst\globals\LinkerTest::noTest>`",
            Linker::getLink("\$test1"));
    }

    public function testLinkToType() {
        RunConfiguration::setLinkToSearchEngine(false);
        $result = Linker::getLink("Foo::member", "description");
        assertEquals("Foo::member description", $result);
    }

    public function testFindFQCN() {
        assertEquals("Foo", Linker::findFQCN("Foo"));
        assertEquals("unit\doc2rst\globals\LinkerTest", Linker::findFQCN(self::class));

        ProcessState::setCurrentClass(null);
        assertEquals("bhenk\doc2rst\globals\Linker", Linker::findFQCN(Linker::class));
        assertEquals("TypeLinker", Linker::findFQCN("TypeLinker"));

        ProcessState::setCurrentClass(new ReflectionClass(Linker::class));
        assertEquals("bhenk\doc2rst\globals\Linker", Linker::findFQCN("Linker"));
        assertEquals("bhenk\doc2rst\globals\TypeLinker", Linker::findFQCN("TypeLinker"));

        ProcessState::setCurrentClass(new ReflectionClass(TypeLinker::class));
        // assumes Log is in use statements of TypeLinker
        assertEquals("bhenk\doc2rst\log\Log", Linker::findFQCN("Log"));
    }
}
