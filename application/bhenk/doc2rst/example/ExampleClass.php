<?php

namespace bhenk\doc2rst\example;

use RuntimeException;

final class ExampleClass {

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
     *
     * ----
     *
     * @param string $string has to be a string!
     * @param string|bool $option you may choose
     * @return ExampleClass|string|null only *null* if no other options remain
     * @throws RuntimeException for the sake of showing this
     * @api
     * @author Dr. Knebhanenveg knebhanenveg@example.com
     * @copyright Dr. Knebhanenveg
     * @deprecated 0.0 this is a test class
     * @generated for testing purposes
     * @internal not part of public api
     * @link https://gitzw.art gitzwart
     * @package bhenk\doc2rst\showcase
     * @see SeeTag
     * @since 0.0
     * @todo explain tag structure
     */
    public function method(string $string, string|bool $option = false): ExampleClass|string|null {
        if (1 == 0) throw new RuntimeException("test 1, 2, 3");
        return new ExampleClass();
    }

}