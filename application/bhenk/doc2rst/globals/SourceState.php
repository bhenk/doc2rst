<?php

namespace bhenk\doc2rst\globals;

use UnitEnum;

class SourceState extends AbstractStaticContainer {

    private static array $directories = [];
    private static array $php_files = [];
    private static array $js_files = [];
    private static array $sql_files = [];
    private static array $md_files = [];
    private static array $rst_files = [];
    private static array $other_files = [];
    private static array $file_order = [];

    /**
     * @param string $id
     * @return UnitEnum|null
     */
    public static function enumForName(string $id): ?UnitEnum {
        return Sources::forName($id);
    }

    public static function toString(): string {
        return (new SourceState())->__toString();
    }

    public static function countFiles(): int {
        return count(self::$js_files)
            + count(self::$md_files)
            + count(self::$php_files)
            + count(self::$other_files)
            + count(self::$rst_files)
            + count(self::$sql_files);
    }

    public static function countDirectories(): int {
        return count(self::$directories);
    }

    /**
     * @param string $directory
     * @return void
     */
    public static function addDirectory(string $directory): void {
        self::addFile($directory);
        self::$directories[] = $directory;
    }

    /**
     * @param string $php_file
     * @return void
     */
    public static function addPhpFile(string $php_file): void {
        self::addFile($php_file);
        self::$php_files[] = $php_file;
    }

    /**
     * @param string $js_file
     * @return void
     */
    public static function addJsFile(string $js_file): void {
        self::addFile($js_file);
        self::$js_files[] = $js_file;
    }

    /**
     * @param string $sql_file
     * @return void
     */
    public static function addSqlFile(string $sql_file): void {
        self::addFile($sql_file);
        self::$sql_files[] = $sql_file;
    }

    /**
     * @param string $md_file
     * @return void
     */
    public static function addMdFile(string $md_file): void {
        self::addFile($md_file);
        self::$md_files[] = $md_file;
    }

    /**
     * @param string $rst_file
     * @return void
     */
    public static function addRstFile(string $rst_file): void {
        self::addFile($rst_file);
        self::$rst_files[] = $rst_file;
    }

    /**
     * @param string $other_file
     * @return void
     */
    public static function addOtherFile(string $other_file): void {
        self::addFile($other_file);
        self::$other_files[] = $other_file;
    }

    private static function addFile(string $rel_path): void {
        self::$file_order[] = $rel_path;
    }

    /**
     * @return array
     */
    public static function getDirectories(): array {
        return self::$directories;
    }

    /**
     * @param array $directories
     */
    public static function setDirectories(array $directories): void {
        self::$directories = $directories;
    }

    /**
     * @return array
     */
    public static function getPhpFiles(): array {
        return self::$php_files;
    }

    /**
     * @param array $php_files
     */
    public static function setPhpFiles(array $php_files): void {
        self::$php_files = $php_files;
    }

    /**
     * @return array
     */
    public static function getJsFiles(): array {
        return self::$js_files;
    }

    /**
     * @param array $js_files
     */
    public static function setJsFiles(array $js_files): void {
        self::$js_files = $js_files;
    }

    /**
     * @return array
     */
    public static function getSqlFiles(): array {
        return self::$sql_files;
    }

    /**
     * @param array $sql_files
     */
    public static function setSqlFiles(array $sql_files): void {
        self::$sql_files = $sql_files;
    }

    /**
     * @return array
     */
    public static function getMdFiles(): array {
        return self::$md_files;
    }

    /**
     * @param array $md_files
     */
    public static function setMdFiles(array $md_files): void {
        self::$md_files = $md_files;
    }

    /**
     * @return array
     */
    public static function getRstFiles(): array {
        return self::$rst_files;
    }

    /**
     * @param array $rst_files
     */
    public static function setRstFiles(array $rst_files): void {
        self::$rst_files = $rst_files;
    }

    /**
     * @return array
     */
    public static function getOtherFiles(): array {
        return self::$other_files;
    }

    /**
     * @param array $other_files
     */
    public static function setOtherFiles(array $other_files): void {
        self::$other_files = $other_files;
    }

    /**
     * @return array
     */
    public static function getFileOrder(): array {
        return self::$file_order;
    }

    /**
     * @param array $file_order
     */
    public static function setFileOrder(array $file_order): void {
        self::$file_order = $file_order;
    }

}