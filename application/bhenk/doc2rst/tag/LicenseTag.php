<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the license tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &license [URI] [description]
 * ```
 */
class LicenseTag extends AbstractLinkTag {

    const TAG = "@license";

    public function getTagName(): string {
        return self::TAG;
    }
}