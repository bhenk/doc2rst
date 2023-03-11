<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the version tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &version [<"Semantic Version">] [<description>]
 * ```
 */
class VersionTag extends AbstractVersionTag {

    /** @inheritdoc */
    const TAG = "@version";

    public function getTagName(): string {
        return self::TAG;
    }
}