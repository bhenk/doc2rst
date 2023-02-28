<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the throws tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &throws ["Type"] [<description>]
 * ```
 */
class ThrowsTag extends AbstractTypeTag {

    const TAG = "@throws";

    public function getTagName(): string {
        return self::TAG;
    }

}