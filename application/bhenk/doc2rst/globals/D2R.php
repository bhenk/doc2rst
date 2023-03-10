<?php

namespace bhenk\doc2rst\globals;

use bhenk\doc2rst\log\Log;
use function array_key_exists;
use function dirname;
use function file_exists;
use function file_get_contents;

class D2R {

    const CONFIGURATION_FILENAME = "d2r-conf.php";
    const STYLES_FILENAME = "d2r-styles.txt";
    const COMMENT_ORDER_FILENAME = "d2r-order.php";

    private static ?string $styles = null;
    private static array $comment_order = [];

    public static function getStyles(): string {
        if (!self::$styles) {
            $styles_file = RunConfiguration::getDocRoot()
                . DIRECTORY_SEPARATOR . self::STYLES_FILENAME;
            if (file_exists($styles_file)) {
                Log::debug("Reading styles from file://" . $styles_file);
            } else {
                $styles_file = dirname(__DIR__)
                    . DIRECTORY_SEPARATOR . "d2r" . DIRECTORY_SEPARATOR . self::STYLES_FILENAME;
                Log::debug("Reading styles from internal file");
            }
            self::$styles = file_get_contents($styles_file);
        }
        return self::$styles;
    }

    public static function getCommentOrder(): array {
        if (empty(self::$comment_order)) {
            $order_file = RunConfiguration::getDocRoot()
                . DIRECTORY_SEPARATOR . self::COMMENT_ORDER_FILENAME;
            if (file_exists($order_file)) {
                Log::debug("Reading comment order from file://" . $order_file);
            } else {
                $order_file = self::getInternalOrderFilename();
                Log::debug("Reading comment order from internal file");
            }
            self::$comment_order = require_once $order_file;
        }
        return self::$comment_order;
    }

    public static function getTagStyle(string $tag_name): string {
        if (array_key_exists($tag_name, self::getCommentOrder())) {
            return self::getCommentOrder()[$tag_name];
        }
        return "";
    }

    public static function getCommentOrderContents(): string {
        $order_file = self::getInternalOrderFilename();
        return file_get_contents($order_file);
    }

    public static function getInternalOrderFilename(): string {
        return dirname(__DIR__)
            . DIRECTORY_SEPARATOR . "d2r" . DIRECTORY_SEPARATOR . self::COMMENT_ORDER_FILENAME;
    }

}