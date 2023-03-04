<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the inheritDoc tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &inheritDoc
 *       {&inheritDoc}
 * ```
 */
class InheritDocTag extends AbstractTag {

    const TAG = "@inheritDoc";

    public function getTagName(): string {
        return self::TAG;
    }

    public function render(): void {}

    public function __toString(): string {
        return "todo: " . self::class;
    }
}