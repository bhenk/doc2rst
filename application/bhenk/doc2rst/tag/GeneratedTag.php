<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the generated tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &generated [description]
 * ```
 */
class GeneratedTag extends AbstractSimpleTag {

    /**
     * @inheritdoc
     */
    const TAG = "@generated";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }
}