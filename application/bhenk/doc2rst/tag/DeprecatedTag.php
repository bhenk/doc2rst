<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the deprecated tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &deprecated [<"Semantic Version">] [<description>]
 * ```
 */
class DeprecatedTag extends AbstractVersionTag {

    /**
     * @inheritdoc
     */
    const TAG = "@deprecated";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }
}