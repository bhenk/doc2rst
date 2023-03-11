<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the internal tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &internal [description]
 *       {&internal [description]}
 * ```
 */
class InternalTag extends AbstractSimpleTag {

    /**
     * @inheritdoc
     */
    const TAG = "@internal";

    public function getTagName(): string {
        return self::TAG;
    }

}