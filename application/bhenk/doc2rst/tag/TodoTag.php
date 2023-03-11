<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the todo tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &todo [description]
 * ```
 */
class TodoTag extends AbstractSimpleTag {

    /**
     * @inheritdoc
     */
    const TAG = "@todo";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

}