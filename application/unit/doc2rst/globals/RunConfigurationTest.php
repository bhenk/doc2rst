<?php

namespace unit\doc2rst\globals;

use bhenk\doc2rst\globals\ContainerException;
use bhenk\doc2rst\globals\NotFoundException;
use bhenk\doc2rst\globals\RC;
use bhenk\doc2rst\globals\RunConfiguration;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertIsString;
use function PHPUnit\Framework\assertStringContainsString;

class RunConfigurationTest extends TestCase {

    public function testGet() {
        RunConfiguration::setDocRoot("/foo/bar");
        $rc = new RunConfiguration();
        assertEquals("/foo/bar", $rc->get("doc_root"));

        $this->expectException(NotFoundException::class);
        $rc->get("not_a_property_of_RunConfiguration");
    }

    public function testHas() {
        $rc = new RunConfiguration();
        assertFalse($rc->has("not_a_property_of_RunConfiguration"));
    }

    public function testGetMethodName() {
        $name = RunConfiguration::getMethodName("foo_bar_baz");
        assertEquals("FooBarBaz", $name);

        $name = RunConfiguration::getMethodName("foo");
        assertEquals("Foo", $name);
    }

    public function testLoad() {
        $configuration = [
            RC::application_root->name => "/foo/bar",
            RC::log_level->name => 100,
            RC::excludes->name => [
                "foo/bar",
                "foo/baz"
            ]
        ];

        RunConfiguration::load($configuration);
        assertEquals("/foo/bar", RunConfiguration::getApplicationRoot());
        assertEquals(100, RunConfiguration::getLogLevel());
        assertEquals(["foo/bar", "foo/baz"], RunConfiguration::getExcludes());
    }

    public function testLoadWithUnknownKey() {
        $configuration = [
            RC::application_root->name => "/foo/bar",
            "foo_bar" => 100,
        ];

        $this->expectExceptionMessage("Unknown key: foo_bar");
        $this->expectException(ContainerException::class);
        RunConfiguration::load($configuration);
    }

    public function testLoadWithWrongTypeString() {
        $configuration = [
            RC::application_root->name => "/foo/bar",
            RC::log_level->name => "a string",
        ];

        $this->expectExceptionMessage("Wrong type for log_level");
        $this->expectException(ContainerException::class);
        RunConfiguration::load($configuration);
    }

    public function testLoadWithWrongTypeInt() {
        $configuration = [
            RC::application_root->name => 42,
            RC::log_level->name => 100,
        ];

        RunConfiguration::load($configuration);
        assertIsString(RunConfiguration::getApplicationRoot());
        assertEquals("42", RunConfiguration::getApplicationRoot());
    }

    public function testToArray(): void {
        $configuration = [
            RC::application_root->name => "/foo/bar",
            RC::log_level->name => 100,
            RC::excludes->name => [
                "foo/bar",
                "foo/baz"
            ]
        ];

        RunConfiguration::load($configuration);
        $arr = RunConfiguration::toArray();
        assertContains("/foo/bar", $arr);
        assertContains(100, $arr);
        assertContains(["foo/bar", "foo/baz"], $arr);
    }

    public function testToString() {
        $configuration = [
            RC::application_root->name => "/foo/bar",
            RC::log_level->name => 100,
            RC::excludes->name => [
                "foo/bar",
                "foo/baz"
            ]
        ];

        RunConfiguration::load($configuration);
        $s = (new RunConfiguration())->__toString();
        //echo $s;
        assertStringContainsString("/foo/bar", $s);
        $s2 = RunConfiguration::toString();
        assertEquals($s, $s2);
    }

}