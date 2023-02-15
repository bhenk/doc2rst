<?php

namespace unit\doc2rst;

use bhenk\doc2rst\Crawler;
use Exception;
use PHPUnit\Framework\TestCase;
use function dirname;
use function file_exists;
use function in_array;
use function is_dir;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertTrue;
use function var_dump;

class CrawlerTest extends TestCase {

    private static string $external_project_dir;

    /**
     * @throws Exception
     */
    public static function setUpBeforeClass(): void {
        $dev_dir = dirname(__DIR__, 4);
        self::$external_project_dir = $dev_dir . DIRECTORY_SEPARATOR . "core-webapp";
        if (!file_exists(self::$external_project_dir) or !is_dir(self::$external_project_dir))
            throw new Exception("external file settings exception");
        parent::setUpBeforeClass();
    }

    private static function abs(string $filename): string {
        return self::$external_project_dir . DIRECTORY_SEPARATOR . $filename;
    }

    public function testConstructor01() {
        $this->expectException(Exception::class);
        new Crawler("not/a/dir", "/not/a/dir/either");
    }

    public function testConstructor02() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Output directory does not exist or is not a directory");
        new Crawler(__DIR__, "/not/a/dir");
    }

    public function testConstructor03() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Input directory does not exist or is not a directory");
        new Crawler("not/a/dir", __DIR__);
    }

    public function testGetCrawlDir() {
        $crawler = new Crawler(self::abs("application/bhenk"), self::abs("docs/api"));
        assertTrue(is_dir($crawler->getInputDir()));
        assertTrue(is_dir($crawler->getOutputDir()));
    }

    public function testCrawl() {
        $crawler = new Crawler(self::abs("application/bhenk"), self::abs("docs/api"));
        $crawler->addExclude("bhenk/corewa/data/json");
        $crawler->addExclude("bhenk/corewa/dao/user/UserDo.php");
        $crawler->makeDocumentTree();

        assertTrue(1 == 1);
    }

}
