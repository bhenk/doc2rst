<?php

namespace bhenk\doc2rst\conf;

use bhenk\doc2rst\model\DocManagerInterface;
use Exception;

class Config {

    private static ?Config $instance = null;

    private function __construct(
        private array               $config,
        private DocManagerInterface $docManager
    ) {}

    public static function load(array $config, DocManagerInterface $docManager): Config {
        self::$instance = new Config($config, $docManager);
        return self::$instance;
    }

    /**
     * Gets the singleton instance of this class.
     *
     * @throws Exception {@link Config::get()} was called before {@link Config::load()}
     */
    public static function get(): Config {
        if (is_null(self::$instance)) {
            throw new Exception(
                "Instance not loaded. Call " . Config::class . "::load() before ::get()");
        }
        return self::$instance;
    }

    /**
     * @return DocManagerInterface
     */
    public function getDocManager(): DocManagerInterface {
        return $this->docManager;
    }

    /**
     * @param DocManagerInterface $docManager
     */
    public function setDocManager(DocManagerInterface $docManager): void {
        $this->docManager = $docManager;
    }

    public function setConfiguration(array $config): void {
        $this->config = $config;
    }

    public function getConfiguration(): array {
        return $this->config;
    }

    public function getValue(string $key) {
        return $this->config[$key] ?? null;
    }

}