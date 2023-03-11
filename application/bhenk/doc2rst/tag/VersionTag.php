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

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }
}