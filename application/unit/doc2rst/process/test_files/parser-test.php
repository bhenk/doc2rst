<?php
/**
 * recommended to have a namespace
 */

namespace unit\doc2rst\process\test_files;

/**
 * multiple line comment
 *
 * This seems to be an important {@link http://example.com link}.
 * @val [] empty array
 */
const CONSTANT_01 = [];
const CONSTANT_02 = "";

$prop_01 = "";
/** one line comment */
$prop_02 = "";

/**
 * Gets some Foo.
 *
 * @return void
 */
function getFoo(string|bool $far, int $too, bool $long = true): void {}

function getBar(): string {
    return "baz";
}

/**
 * documentation on require statement
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . "parser-test.php";

/** This php file will return an array full of things */
return ["array" => "full", "of" => "things"];

