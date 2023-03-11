<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the since tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &since [<"Semantic Version">] [<description>]
 * ```
 */
class SinceTag extends AbstractVersionTag {

    /**
     * @inheritdoc
     */
    const TAG = "@since";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

}