<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the see tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &see [URI | "FQSEN"] [<description>]
 * ```
 */
class SeeTag extends AbstractLinkTag {

    const TAG = "@see";


    public function getTagName(): string {
        return self::TAG;
    }

}