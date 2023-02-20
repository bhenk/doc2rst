<?php

namespace bhenk\doc2rst\globals;

use UnitEnum;

class ProcessState extends AbstractContainer {

    private static array $scanned_php_files = [];
    private static array $scanned_js_files = [];
    private static array $scanned_sql_files = [];
    private static array $scanned_package_files = [];

    public static function enumForName(string $id): ?UnitEnum {
        return PS::forName($id);
    }

    /**
     * @return array
     */
    public static function getScannedPhpFiles(): array {
        return self::$scanned_php_files;
    }

    /**
     * @param string $filename
     */
    public static function addScannedPhpFiles(string $filename): void {
        self::$scanned_php_files[] = $filename;
    }

    /**
     * @return array
     */
    public static function getScannedJsFiles(): array {
        return self::$scanned_js_files;
    }

    /**
     * @param string $filename
     */
    public static function addScannedJsFiles(string $filename): void {
        self::$scanned_js_files[] = $filename;
    }

    /**
     * @return array
     */
    public static function getScannedSqlFiles(): array {
        return self::$scanned_sql_files;
    }

    /**
     * @param string $filename
     */
    public static function addScannedSqlFiles(string $filename): void {
        self::$scanned_sql_files[] = $filename;
    }

    /**
     * @return array
     */
    public static function getScannedPackageFiles(): array {
        return self::$scanned_package_files;
    }

    /**
     * @param string $filename
     */
    public static function addScannedPackageFiles(string $filename): void {
        self::$scanned_package_files[] = $filename;
    }

}