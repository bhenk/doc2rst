<?php

namespace bhenk\doc2rst\globals;

use function explode;
use function file_get_contents;
use function in_array;
use function sha1;
use function strlen;
use function strrpos;
use function substr;

class DocState {

    private static bool $preRun = true;
    private static array $preRunFiles = [];
    private static array $preRunDirs = [];
    private static array $postRunFiles = [];
    private static array $postRunDirs = [];

    /**
     * @return bool
     */
    public static function isPreRun(): bool {
        return self::$preRun;
    }

    /**
     * @param bool $preRun
     */
    public static function setPreRun(bool $preRun): void {
        self::$preRun = $preRun;
    }

    public static function addAbsoluteFile(string $abs_file): void {
        $hash = self::getHash($abs_file);
        if (self::$preRun) {
            self::$preRunFiles[$abs_file] = $hash;
        } else {
            self::$postRunFiles[$abs_file] = $hash;
        }
    }

    public static function addAbsoluteDir(string $abs_dir): void {
        if (self::$preRun) {
            self::$preRunDirs[] = $abs_dir;
        } else {
            $path = RunConfiguration::getApiDirectory();
            $rel_dir = substr($abs_dir, strlen($path) + 1);
            $dirs = explode(DIRECTORY_SEPARATOR, $rel_dir);
            foreach ($dirs as $dir) {
                if (!empty($dir)) {
                    $path = $path . DIRECTORY_SEPARATOR . $dir;
                    if (!in_array($path, self::$postRunDirs)) self::$postRunDirs[] = $path;
                }
            }
        }
    }

    public static function getHash(string $filename): string {
        $contents = file_get_contents($filename);
        $pos = strrpos($contents, "----");
        return sha1(substr($contents, 0, $pos));
    }

    /**
     * @return array
     */
    public static function getPreRunFiles(): array {
        return self::$preRunFiles;
    }

    /**
     * @param array $preRunFiles
     */
    public static function setPreRunFiles(array $preRunFiles): void {
        self::$preRunFiles = $preRunFiles;
    }

    /**
     * @return array
     */
    public static function getPreRunDirs(): array {
        return self::$preRunDirs;
    }

    /**
     * @param array $preRunDirs
     */
    public static function setPreRunDirs(array $preRunDirs): void {
        self::$preRunDirs = $preRunDirs;
    }

    /**
     * @return array
     */
    public static function getPostRunFiles(): array {
        return self::$postRunFiles;
    }

    /**
     * @param array $postRunFiles
     */
    public static function setPostRunFiles(array $postRunFiles): void {
        self::$postRunFiles = $postRunFiles;
    }

    /**
     * @return array
     */
    public static function getPostRunDirs(): array {
        return self::$postRunDirs;
    }

    /**
     * @param array $postRunDirs
     */
    public static function setPostRunDirs(array $postRunDirs): void {
        self::$postRunDirs = $postRunDirs;
    }


}