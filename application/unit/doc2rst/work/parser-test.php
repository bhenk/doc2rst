<?php
/** recommended to have a namespace */

namespace unit\doc2rst\process;

/**
 * multiple line comment on CONSTANT_01
 */
const CONSTANT_01 = [];
const CONSTANT_02 = "";

$prop_01 = "";
/** used for testing one-line comments */
$prop_02 = "";

/**
 * Gets some Foo.
 *
 * @return void
 */
function getFoo(): void {}

function getBar(): string {
    return "baz";
}

/**
 * documentation on require statement
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . "parser-test.php";

/** This php file will return an array full of things */
return ["array" => "full", "of" => "things"];

