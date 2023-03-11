<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the return tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &return <"Type"> [description]
 * ```
 */
class ReturnTag extends AbstractTypeTag {

    /**
     * @inheritdoc
     */
    const TAG = "@return";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

}