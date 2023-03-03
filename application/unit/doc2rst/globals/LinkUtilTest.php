<?php

namespace unit\doc2rst\globals;

use bhenk\doc2rst\globals\LinkUtil;
use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\globals\SourceState;
use PHPUnit\Framework\SelfDescribing;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use function dirname;
use function PHPUnit\Framework\assertEquals;
use function str_replace;

class LinkUtilTest extends TestCase {

    /**
     * @param string $nr0
     * @param string|null $nr1
     * @param string|null $nr2
     * @param bool|string|int|float|array|object|null $nr3
     * @param mixed $nr4
     * @param LinkUtilTest|null $nr5
     * @param LinkUtil $nr6
     * @param LinkUtil|null $nr7
     * @param LinkUtil|null $nr8
     * @param bool|LinkUtil|string|null $nr9
     * @param ReflectionClass|string $nr10
     * @param LinkUtilTest $nr11
     * @param SelfDescribing $nr12
     * @param bool $testing
     * @return string|int|LinkUtil|LinkUtilTest
     */
    public function noTestCase(string                                  $nr0,
                               ?string                                 $nr1,
                               null|string                             $nr2,
                               null|bool|string|int|float|array|object $nr3,
                               mixed                                   $nr4,
                               ?self                                   $nr5,
                               LinkUtil                                $nr6,
                               ?LinkUtil                               $nr7,
                               LinkUtil|null                           $nr8,
                               bool|LinkUtil|string|null               $nr9,
                               ReflectionClass|string                  $nr10,
                               LinkUtilTest                            $nr11,
                               SelfDescribing                          $nr12,
                               bool                                    $testing = false): string|LinkUtil|static {
        return "";
    }

    public function testResolveReflectionStringType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[0]->getType());
        $expected = "string";
        assertEquals($expected, $result, $params[0]->getName());
    }

    public function testResolveReflectionNullableStringType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[1]->getType());
        $expected = "?\ string";
        assertEquals($expected, $result, $params[1]->getName());
    }

    public function testResolveReflectionNullStringType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[2]->getType());
        $expected = "?\ string";
        assertEquals($expected, $result, $params[2]->getName());
    }

    public function testResolveReflectionNullStringBoolEtcType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[3]->getType());
        $expected = "object | array | string | int | float | bool | null"; // always in this order?
        assertEquals($expected, $result, $params[3]->getName());
    }

    public function testResolveReflectionMixedType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[4]->getType());
        $expected = "mixed";
        assertEquals($expected, $result, $params[4]->getName());
    }

    public function testResolveReflectionSelfType() {
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[5]->getType());
        $expected = "?\ self";
        assertEquals($expected, $result, $params[5]->getName());
    }

    public function testResolveDocumentedClass() {
        SourceState::addPhpFile(str_replace("\\", "/", LinkUtil::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[6]->getType());
        $expected = ":ref:`bhenk\doc2rst\globals\LinkUtil`";
        assertEquals($expected, $result, $params[6]->getName());
    }

    public function testResolveUserNullableDocumentedClass() {
        SourceState::addPhpFile(str_replace("\\", "/", LinkUtil::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[7]->getType());
        $expected = "?\ :ref:`bhenk\doc2rst\globals\LinkUtil`";
        assertEquals($expected, $result, $params[7]->getName());
    }

    public function testResolveDocumentedClassNull() {
        SourceState::addPhpFile(str_replace("\\", "/", LinkUtil::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[8]->getType());
        $expected = "?\ :ref:`bhenk\doc2rst\globals\LinkUtil`";
        assertEquals($expected, $result, $params[8]->getName());
    }

    public function testResolveDocumentedClassStringNull() { // nr9
        SourceState::addPhpFile(str_replace("\\", "/", LinkUtil::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[9]->getType());
        $expected = ":ref:`bhenk\doc2rst\globals\LinkUtil` | string | bool | null";
        assertEquals($expected, $result, $params[9]->getName());
    }

    public function testResolveInternalClassString() { // nr10
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[10]->getType());
        $expected = "`ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string";
        assertEquals($expected, $result, $params[10]->getName());
    }

    public function testResolveUserProvidedLink() { // nr11
        RunConfiguration::setUserProvidedLinks([self::class =>
            "https://somewhere/there/is/documentation/on/LinkUtilTest"]);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[11]->getType());
        $expected = "`LinkUtilTest <https://somewhere/there/is/documentation/on/LinkUtilTest>`_";
        assertEquals($expected, $result, $params[11]->getName());
        RunConfiguration::setUserProvidedLinks([]);
    }

    public function testResolveUserProvidedBaseUrl() { // nr11
        RunConfiguration::setUserProvidedLinks(["unit\doc2rst" =>
            "https://github.com/bhenk/doc2rst/tree/main/application"]);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[11]->getType());
        $expected = "`LinkUtilTest <https://github.com/bhenk/doc2rst/tree/main/application/unit/doc2rst/globals/LinkUtilTest.php>`_";
        assertEquals($expected, $result, $params[11]->getName());
        RunConfiguration::setUserProvidedLinks([]);
    }

    public function testResolveSourceLink() { // nr12
        RunConfiguration::setLinkToSources(true);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[12]->getType());
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
        $result = LinkUtil::resolveReflectionType($params[12]->getType());
        $expected = "`SelfDescribing <https://www.google.com/search?q=PHPUnit\Framework\SelfDescribing>`_";
        assertEquals($expected, $result, $params[12]->getName());
    }

    public function testLastResort() { // nr12
        RunConfiguration::setLinkToSources(false);
        RunConfiguration::setLinkToSearchEngine(false);
        $method = new ReflectionMethod(self::class, "noTestCase");
        $params = $method->getParameters();
        $result = LinkUtil::resolveReflectionType($params[12]->getType());
        $expected = "PHPUnit\\\Framework\\\SelfDescribing";
        // actually: PHPUnit\\Framework\\SelfDescribing
        assertEquals($expected, $result, $params[12]->getName());
        RunConfiguration::setLinkToSearchEngine(true);
    }

    public function testReturnTypes() {
        SourceState::addPhpFile(str_replace("\\", "/", LinkUtil::class) . ".php");
        $method = new ReflectionMethod(self::class, "noTestCase");
        $result = LinkUtil::resolveReflectionType($method->getReturnType());
        $expected = ":ref:`bhenk\doc2rst\globals\LinkUtil` | static | string";
        assertEquals($expected, $result, "result type with static");
    }
}
