<?php

namespace bhenk\doc2rst\globals;

use UnitEnum;

class RunConfiguration extends AbstractStaticContainer {

    private static ?string $application_root = null;
    private static ?string $vendor_directory = null;
    private static ?string $doc_root = null;
    private static ?string $api_directory = null;
    private static array $excludes = [];
    private static int $log_level = 200;
    private static ?string $api_docs_title = null;
    private static int $toctree_max_depth = 0;
    private static bool $toctree_titles_only = true;
    private static bool $show_class_contents = true;
    private static array $user_provided_links = [];
    private static bool $link_to_sources = false;
    private static bool $link_to_search_engine = true;

    public static function enumForName(string $id): ?UnitEnum {
        return RC::forName($id);
    }

    public static function reset(): array {
        $configuration = parent::reset();
        $configuration[RC::log_level->name] = 200;
        $configuration[RC::toctree_titles_only->name] = true;
        $configuration[RC::show_class_contents->name] = true;
        self::load($configuration);
        return $configuration;
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
     * @param string|null $application_root
     */
    public static function setApplicationRoot(?string $application_root): void {
        self::$application_root = $application_root;
    }

    /**
     * @return string|null
     */
    public static function getVendorDirectory(): ?string {
        return self::$vendor_directory;
    }

    /**
     * @param string|null $vendor_directory
     */
    public static function setVendorDirectory(?string $vendor_directory): void {
        self::$vendor_directory = $vendor_directory;
    }

    /**
     * @return string|null
     */
    public static function getDocRoot(): ?string {
        return self::$doc_root;
    }

    /**
     * @param string|null $doc_root
     */
    public static function setDocRoot(?string $doc_root): void {
        self::$doc_root = $doc_root;
    }

    /**
     * @return string|null
     */
    public static function getApiDirectory(): ?string {
        return self::$api_directory;
    }

    /**
     * @param string|null $api_directory
     */
    public static function setApiDirectory(?string $api_directory): void {
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

    public static function addExcluded(string $path): void {
        self::$excludes[] = $path;
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

    /**
     * @return int
     */
    public static function getToctreeMaxDepth(): int {
        return self::$toctree_max_depth;
    }

    /**
     * @param int $toctree_max_depth
     */
    public static function setToctreeMaxDepth(int $toctree_max_depth): void {
        self::$toctree_max_depth = $toctree_max_depth;
    }

    /**
     * @return bool
     */
    public static function getToctreeTitlesOnly(): bool {
        return self::$toctree_titles_only;
    }

    /**
     * @param bool $toctree_titles_only
     */
    public static function setToctreeTitlesOnly(bool $toctree_titles_only): void {
        self::$toctree_titles_only = $toctree_titles_only;
    }

    /**
     * @return bool
     */
    public static function getShowClassContents(): bool {
        return self::$show_class_contents;
    }

    /**
     * @param bool $show_class_contents
     */
    public static function setShowClassContents(bool $show_class_contents): void {
        self::$show_class_contents = $show_class_contents;
    }

    /**
     * @return array
     */
    public static function getUserProvidedLinks(): array {
        return self::$user_provided_links;
    }

    /**
     * @param array $user_provided_links
     */
    public static function setUserProvidedLinks(array $user_provided_links): void {
        self::$user_provided_links = $user_provided_links;
    }

    public static function addUserProvidedLink(string $key, string $location) {
        self::$user_provided_links[$key] = $location;
    }

    /**
     * @return bool
     */
    public static function getLinkToSources(): bool {
        return self::$link_to_sources;
    }

    /**
     * @param bool $link_to_sources
     */
    public static function setLinkToSources(bool $link_to_sources): void {
        self::$link_to_sources = $link_to_sources;
    }

    /**
     * @return bool
     */
    public static function getLinkToSearchEngine(): bool {
        return self::$link_to_search_engine;
    }

    /**
     * @param bool $link_to_search_engine
     */
    public static function setLinkToSearchEngine(bool $link_to_search_engine): void {
        self::$link_to_search_engine = $link_to_search_engine;
    }

}