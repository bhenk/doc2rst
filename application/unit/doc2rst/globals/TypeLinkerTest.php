<?php

namespace unit\doc2rst\globals;

use Attribute;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\globals\TypeLinker;
use Fiber;
use PHPUnit\Framework\SelfDescribing;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionMethod;
use function dirname;
use function PHPUnit\Framework\assertEquals;
use function str_replace;

class TypeLinkerTest extends TestCase {

    /**
     * @param string $nr0
     * @param string|null $nr1
     * @param string|null $nr2
     * @param bool|string|int|float|array|object|null $nr3
     * @param mixed $nr4
     * @param TypeLinkerTest|null $nr5
     * @param TypeLinker $nr6
     * @param TypeLinker|null $nr7
     * @param TypeLinker|null $nr8
     * @param bool|TypeLinker|string|null $nr9
     * @param ReflectionClass|string $nr10
     * @param TypeLinkerTest $nr11
     * @param SelfDescribing $nr12
     * @param bool $testing
     * @return string|TypeLinker|TypeLinkerTest
     */
    public function noTestCase(string                                  $nr0,
                               ?string                                 $nr1,
                               null|string                             $nr2,
                               null|bool|string|int|float|array|object $nr3,
                               mixed                                   $nr4,
                               ?self                                   $nr5,
                               TypeLinker                              $nr6,
                               ?TypeLinker                             $nr7,
                               TypeLinker|null                         $nr8,
                               bool|TypeLinker|string|null             $nr9,
                               ReflectionClass|string                  $nr10,
                               TypeLinkerTest                          $nr11,
                               SelfDescribing                          $nr12,
                               bool                                    $testing = false): string|TypeLinker|static {
        return "";
    }

    public function testResolveReflectionStringType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[0]->getType());
        $expected = "string";
        assertEquals($expected, $result, $params[0]->getName());
    }

    public function testResolveReflectionNullableStringType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[1]->getType());
        $expected = "?\ string";
        assertEquals($expected, $result, $params[1]->getName());
    }

    public function testResolveReflectionNullStringType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[2]->getType());
        $expected = "?\ string";
        assertEquals($expected, $result, $params[2]->getName());
    }

    public function testResolveReflectionNullStringBoolEtcType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[3]->getType());
        $expected = "object | array | string | int | float | bool | null"; // always in this order?
        assertEquals($expected, $result, $params[3]->getName());
    }

    public function testResolveReflectionMixedType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[4]->getType());
        $expected = "mixed";
        assertEquals($expected, $result, $params[4]->getName());
    }

    public function testResolveReflectionSelfType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[5]->getType());
        $expected = "?\ self";
        assertEquals($expected, $result, $params[5]->getName());
    }

    public function testResolveDocumentedClass() {
        SourceState::addPhpFile(str_replace("\\", "/", TypeLinker::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[6]->getType());
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker`";
        assertEquals($expected, $result, $params[6]->getName());
    }

    public function testResolveUserNullableDocumentedClass() {
        SourceState::addPhpFile(str_replace("\\", "/", TypeLinker::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[7]->getType());
        $expected = "?\ :ref:`bhenk\doc2rst\globals\TypeLinker`";
        assertEquals($expected, $result, $params[7]->getName());
    }

    public function testResolveDocumentedClassNull() {
        SourceState::addPhpFile(str_replace("\\", "/", TypeLinker::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[8]->getType());
        $expected = "?\ :ref:`bhenk\doc2rst\globals\TypeLinker`";
        assertEquals($expected, $result, $params[8]->getName());
    }

    public function testResolveDocumentedClassStringNull() { // nr9
        SourceState::addPhpFile(str_replace("\\", "/", TypeLinker::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[9]->getType());
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker` | string | bool | null";
        assertEquals($expected, $result, $params[9]->getName());
    }

    public function testResolveInternalClassString() { // nr10
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[10]->getType());
        $expected = "`ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string";
        assertEquals($expected, $result, $params[10]->getName());
    }

    public function testResolveUserProvidedLink() { // nr11
        RunConfiguration::setUserProvidedLinks([self::class =>
            "https://somewhere/there/is/documentation/on/TypeLinkerTest"]);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[11]->getType());
        $expected = "`TypeLinkerTest <https://somewhere/there/is/documentation/on/TypeLinkerTest>`_";
        assertEquals($expected, $result, $params[11]->getName());
        RunConfiguration::setUserProvidedLinks([]);
    }

    public function testResolveUserProvidedBaseUrl() { // nr11
        RunConfiguration::setUserProvidedLinks(["unit\doc2rst" =>
            "https://github.com/bhenk/doc2rst/tree/main/application"]);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[11]->getType());
        $expected = "`TypeLinkerTest <https://github.com/bhenk/doc2rst/tree/main/application/unit/doc2rst/globals/TypeLinkerTest.php>`_";
        assertEquals($expected, $result, $params[11]->getName());
        RunConfiguration::setUserProvidedLinks([]);
    }

    public function testResolveSourceLink() { // nr12
        RunConfiguration::setLinkToSources(true);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[12]->getType());
        $vendor_dir = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . "vendor";
        $expected = "`SelfDescribing <file://$vendor_dir/phpunit/phpunit/src/Framework/SelfDescribing.php>`_";
        assertEquals($expected, $result, $params[12]->getName());
        RunConfiguration::setLinkToSources(false);
    }

    public function testResolveLinkToSearchEngine() { // nr12
        RunConfiguration::setLinkToSources(false);
        RunConfiguration::setLinkToSearchEngine(true);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[12]->getType());
        $expected = "`SelfDescribing <https://www.google.com/search?q=PHPUnit\Framework\SelfDescribing>`_";
        assertEquals($expected, $result, $params[12]->getName());
    }

    public function testLastResort() { // nr12
        RunConfiguration::setLinkToSources(false);
        RunConfiguration::setLinkToSearchEngine(false);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = TypeLinker::resolveReflectionType($params[12]->getType());
        $expected = "PHPUnit\\\Framework\\\SelfDescribing";
        // actually: PHPUnit\\Framework\\SelfDescribing
        assertEquals($expected, $result, $params[12]->getName());
        RunConfiguration::setLinkToSearchEngine(true);
    }

    public function testReturnTypes() {
        SourceState::addPhpFile(str_replace("\\", "/", TypeLinker::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $result = TypeLinker::resolveReflectionType($method->getReturnType());
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker` | static | string";
        assertEquals($expected, $result, "result type with static");
    }

    public function testCreateDocumentedClassReference() {
        SourceState::addPhpFile(str_replace("\\", "/", TypeLinker::class) . ".php");
        $namedType = new ReflectionClass(TypeLinker::class);
        $result = TypeLinker::createDocumentedClassReference($namedType);
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker`";
        assertEquals($expected, $result, "ReflectionClass, null");

        $method = new ReflectionMethod(TypeLinker::class, "createDocumentedClassReference");
        $result = TypeLinker::createDocumentedClassReference($namedType, $method);
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker::createDocumentedClassReference`";
        assertEquals($expected, $result, "ReflectionClass, ReflectionMethod");

        $result = TypeLinker::createDocumentedClassReference(TypeLinker::class, $method);
        assertEquals($expected, $result, "string, ReflectionMethod");

        $result = TypeLinker::createDocumentedClassReference(TypeLinker::class, "createDocumentedClassReference");
        assertEquals($expected, $result, "string, string");

        $constant = new ReflectionClassConstant(TypeLinker::class, "PHP_CLASS_NET");
        $result = TypeLinker::createDocumentedClassReference(TypeLinker::class, $constant);
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker::PHP_CLASS_NET`";
        assertEquals($expected, $result, "string, ReflectionClassConstant");

        $result = TypeLinker::createDocumentedClassReference(TypeLinker::class, "PHP_CLASS_NET");
        assertEquals($expected, $result, "string, string-constant");
    }

    public function testCreateInternalClassLink() {
        $namedType = new ReflectionClass(Fiber::class);
        $result = TypeLinker::createInternalClassLink($namedType);
        $expected = "`Fiber <https://www.php.net/manual/en/class.fiber.php>`_";
        assertEquals($expected, $result, "ReflectionClass, null");

        $method = new ReflectionMethod(Fiber::class, "isRunning");
        $result = TypeLinker::createInternalClassLink($namedType, $method);
        $expected = "`Fiber::isRunning <https://www.php.net/manual/en/fiber.isrunning.php>`_";
        assertEquals($expected, $result, "ReflectionClass, ReflectionMethod");

        $namedType = new ReflectionClass(Attribute::class);
        $constant = new ReflectionClassConstant(Attribute::class, "TARGET_METHOD");
        $result = TypeLinker::createInternalClassLink($namedType, $constant);
        $expected = "`Attribute::TARGET_METHOD <https://www.php.net/manual/en/class.attribute.php>`_";
        assertEquals($expected, $result, "ReflectionClass, ReflectionClassConstant");

        $result = TypeLinker::createInternalClassLink($namedType, "TARGET_METHOD");
        assertEquals($expected, $result, "ReflectionClass, string-constant");
    }

    public function testCreateSourceLink() {
        RunConfiguration::setLinkToSources(true);
        $namedType = new ReflectionClass(TestCase::class);
        $result = TypeLinker::createSourceLink($namedType, "expectException");
        $expected = "`TestCase::expectException <file:///Users/ecco/PhpstormProjects/doc2rst/vendor/phpunit/phpunit/src/Framework/TestCase.php:597>`_";
        assertEquals($expected, $result, "ReflectionClass, method, line number");
        RunConfiguration::setLinkToSources(false);
    }

    public function testResolveFQCNStringType() {
        $namedType = TypeLinker::class;
        $result = TypeLinker::resolveFQCN($namedType);
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker`";
        assertEquals($expected, $result, "FQCN string");
    }

    public function testResolveFQCNStringTypeNull() {
        $namedType = "?" . TypeLinker::class;
        $result = TypeLinker::resolveFQCN($namedType);
        $expected = "?\ :ref:`bhenk\doc2rst\globals\TypeLinker`";
        assertEquals($expected, $result, "FQCN string allows null");
    }

    public function testResolveFQCNStringMulti() {
        $namedType = TypeLinker::class . "|string|null";
        $result = TypeLinker::resolveFQCN($namedType);
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker` | string | null";
        assertEquals($expected, $result, "FQCN string multi");
    }

    public function testResolveFQCNClassMethod() {
        $namedType = new ReflectionClass(TypeLinker::class);
        $member = new ReflectionMethod(TypeLinker::class, "resolveFQCN");
        $result = TypeLinker::resolveFQCN($namedType, $member);
        $expected = ":ref:`bhenk\doc2rst\globals\TypeLinker::resolveFQCN`";
        assertEquals($expected, $result, "FQCN namedType, member");
    }
}
