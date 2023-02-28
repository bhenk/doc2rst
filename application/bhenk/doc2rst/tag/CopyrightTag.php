<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the copyright tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &copyright <description>
 * ```
 */
class CopyrightTag extends AbstractSimpleTag {

    const TAG = "@copyright";

    public function getTagName(): string {
        return self::TAG;
    }

}