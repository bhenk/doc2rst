<?php

namespace bhenk\doc2rst\globals;

use UnitEnum;

class RunConfiguration extends AbstractStaticContainer {

    private static ?string $application_root = null;
    private static ?string $source_directory = null;
    private static ?string $doc_root = null;
    private static ?string $api_directory = null;
    private static array $excludes = [];
    private static int $log_level = 0;
    private static ?string $api_docs_title = null;

    public static function enumForName(string $id): ?UnitEnum {
        return RC::forName($id);
    }

    public static function toString(): string {
        return (new RunConfiguration())->__toString();
    }

    /**
     * @return string|null
     */
    public static function getApplicationRoot(): ?string {
        return self::$application_root;
    }

    /**
     * @param string $application_root
     */
    public static function setApplicationRoot(string $application_root): void {
        self::$application_root = $application_root;
    }

    /**
     * @return string|null
     */
    public static function getSourceDirectory(): ?string {
        return self::$source_directory;
    }

    /**
     * @param string $source_directory
     */
    public static function setSourceDirectory(string $source_directory): void {
        self::$source_directory = $source_directory;
    }

    /**
     * @return string|null
     */
    public static function getDocRoot(): ?string {
        return self::$doc_root;
    }

    /**
     * @param string $doc_root
     */
    public static function setDocRoot(string $doc_root): void {
        self::$doc_root = $doc_root;
    }

    /**
     * @return string|null
     */
    public static function getApiDirectory(): ?string {
        return self::$api_directory;
    }

    /**
     * @param string $api_directory
     */
    public static function setApiDirectory(string $api_directory): void {
        self::$api_directory = $api_directory;
    }

    /**
     * @return int|null
     */
    public static function getLogLevel(): ?int {
        return self::$log_level;
    }

    /**
     * @param int $log_level
     */
    public static function setLogLevel(int $log_level): void {
        self::$log_level = $log_level;
    }

    /**
     * @return array
     */
    public static function getExcludes(): array {
        return self::$excludes;
    }

    /**
     * @param array $excludes
     */
    public static function setExcludes(array $excludes): void {
        self::$excludes = $excludes;
    }

    /**
     * @return string|null
     */
    public static function getApiDocsTitle(): ?string {
        return self::$api_docs_title;
    }

    /**
     * @param string|null $api_docs_title
     */
    public static function setApiDocsTitle(?string $api_docs_title): void {
        self::$api_docs_title = $api_docs_title;
    }

}