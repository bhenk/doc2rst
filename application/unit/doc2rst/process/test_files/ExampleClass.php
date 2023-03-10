<?php

namespace unit\doc2rst\process\test_files;

use Composer\Autoload\ClassLoader;
use Composer\InstalledVersions;
use RuntimeException;

/**
 * Shows several applications of PHPdoc comments
 *
 * This is the description of this class.
 *
 * @package bhenk\doc2rst\showcase
 * @author Dr. Knebhannenveg knebhannenveg@example.com
 * @copyright Dr. Knebhannenveg
 * @version 0.0.0 2023-03-01
 * @license https://www.apache.org/licenses/LICENSE-2.0.txt Apache 2.0
 *
 */
final class ExampleClass {

    /**
     * Shows a constant holding an int value.
     */
    const AN_INT_CONSTANT = 1;

    /**
     * Shows a constant holding a string value.
     */
    const A_STRING_CONSTANT = "Very long strings will be cut off at a certain length. If you wish to see the "
    . "whole thing just look at the code.";

    /**
     * Shows a constant holding an array value.
     */
    const AN_ARRAY_CONSTANT = ["foo" => "bar", 0, 1, 2, 3, "baz" => ["foo" => "bar", 0, 1, 2, 3,]];

    /**
     * Constructs a new {@link ExampleClass}.
     *
     * This class has no functional purpose.
     *
     * @param string $foo description of this parameter
     * @param string $bar I'd love to
     * @param bool $make_baz hmm... not really
     */
    function __construct(private readonly string $foo, string $bar, bool $make_baz = true) {
        if ($this->foo == "") $make_baz = false;
    }

    /**
     * ``This`` is the ``summary`` for this *method*
     *
     * Caveat summary: only markup surrounding single words will be preserved. It is not possible to have
     * **more than one word** ``quoted`` or *italic* in this first sentence.
     *
     * ----
     *
     * This is the description of **this** method.
     *
     * It can have inline links like {@link https://example.com}. The inline
     * link can also have a description that is displayed instead of the *uri*:
     * {@link https://example.com this is the description}. Other inline tags are permitted as well.
     * A link to a parameter (from this method) is rendered as {@link $option}.
     *
     * If we link to an :tech:`external class` like {@link InstalledVersions::getAllRawData()} and configuration option
     * ``link_to_sources`` is set to *true*, we get a link to the file in the (composer) vendor directory, even
     * to the line number of the specified member.
     * Unfortunately the file-link to a line number (as in the above) will only work in some IDE's, not in
     * your browser.
     * @foo bar
     * @bazeertyu foo
     *      bngh
     * @param string|bool $option you may choose
     *
     * @param string $string
     *   has to be a string!
     * @return ExampleClass|string|null only *null* if no other options remain
     *    and the postman rings
     *
     * ```
     *    some code
     *    and more
     * ```
     *
     * @throws RuntimeException for the sake of showing this
     * @uses foo
     * @api
     * @author hb hb@example.com nog een
     * @copyright hb
     * @bar tig
     * @very_long_123456 bar soda tig
     * @license https://www.apache.org/licenses/LICENSE-2.0.txt Apache 2.0
     * @package foo\bar
     * @deprecated 0.0 this is a test class
     * @generated for testing purposes
     *   nog een regel
     * @internal not part of public api
     * @link https://gitzw.art gitzwart
     * @version 1.0
     * @see  SeeTag
     * @since 0.0
     * @todo explain tag structure
     */
    public function method(string $string, string|bool $option = false, ClassLoader $cl = null): ExampleClass|string|null {
        if (1 == 0) throw new RuntimeException("test 1, 2, 3");
        return new ExampleClass("foo", "bar");
    }

    public function method2($foo): void {}

}