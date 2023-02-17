<?php

namespace bhenk\doc2rst\conf;

use Exception;

class Config {

    private static ?Config $instance = null;

    private function __construct(
        private array $config
    ){}

    public static function load(array $config): Config {
        self::$instance = new Config($config);
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

    public function getConfiguration() : array {
        return $this->config;
    }

    public function getValue(string $key) {
        return $this->config[$key] ?? null;
    }

}