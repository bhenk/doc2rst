<?php

namespace unit\doc2rst\work;

use bhenk\doc2rst\conf\Config;
use bhenk\doc2rst\work\DocCommentReader;
use bhenk\doc2rst\work\DocManager;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use function PHPUnit\Framework\assertEquals;

const nl2 = PHP_EOL . PHP_EOL;

/**
 * Class under test reads this.
 */
class DocCommentReaderTest extends TestCase {

    private DocCommentReader $dcr;
    private DocManager $docManager;

    public function setUp(): void {
        $this->dcr = new DocCommentReader();
        $this->docManager = new DocManager();
        Config::load([], $this->docManager);
        parent::setUp();
    }

    public function testReadDoc(): void {
        $s = $this->dcr->readDoc((new ReflectionClass($this))->getDocComment());
        assertEquals("**Class under test reads this**" . nl2, $s);
    }

    public function testProcessFirstLine(): void {
        $s = $this->dcr->processFirstLine("This is a heading");
        assertEquals("**This is a heading**" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is a heading ");
        assertEquals("**This is a heading**" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is a heading.");
        assertEquals("**This is a heading**" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is a heading. This is not.");
        assertEquals("**This is a heading**" . nl2, $s);
    }

    public function testProcessFirstLineWithLink(): void {

        $s = $this->dcr->processFirstLine("This is a heading to http://some.where.com");
        assertEquals("**This is a heading to** http://some.where.com" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is a heading to http://some.where.com and more");
        assertEquals("**This is a heading to** http://some.where.com **and more**" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is a heading to http://some.where.com.");
        assertEquals("**This is a heading to** http://some.where.com" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is a heading to http://some.where.com and more.");
        assertEquals("**This is a heading to** http://some.where.com **and more**" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is a heading to http://some.where.com and more  ");
        assertEquals("**This is a heading to** http://some.where.com **and more**" . nl2, $s);
    }

    /**
     * An inline link to {@link DocManager}.
     *
     * !! not supported:
     * or a link to {@link DocManager description} etc.
     *
     * @link https://www.php.net/manual/en/class.reflectionclass.php
     *
     * @return void
     */
    public function testProcessFirstLineWithInternalLinkTag(): void {
        // set the DocManager
        $this->docManager->setScannedDocuments(["bla/foo/Class.php", "name/space/MyClass.php", "n/s/Any.php"]);

        $s = $this->dcr->processFirstLine("This is a heading {@link MyClass::someMethod}");
        assertEquals("**This is a heading** :ref:`name\space\MyClass::someMethod`" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is a heading {@link MyClass::someMethod} and more");
        assertEquals("**This is a heading** :ref:`name\space\MyClass::someMethod` **and more**" . nl2, $s);

        $s = $this->dcr->processFirstLine("This is {@link name\space\MyClass::someMethod} and more");
        assertEquals("**This is** :ref:`name\space\MyClass::someMethod` **and more**" . nl2, $s);
    }

    public function testProcessFirstLineWithExternalLinkTag(): void {
        // set the DocManager
        $this->docManager->setScannedDocuments([]);

        $s = $this->dcr->processFirstLine("This is {@link ReflectionClass} and more.");
        assertEquals("**This is** `ReflectionClass "
            . "<https://www.php.net/manual/en/class.reflectionclass.php>`_ **and more**" . nl2, $s);

        $s = $this->dcr->processFirstLine("Next is {@link ReflectionClass::getAttributes()} and more.");
        assertEquals("**Next is** `ReflectionClass "
            . "<https://www.php.net/manual/en/reflectionclass.getattributes.php>`_ **and more**" . nl2, $s);

    }

}
