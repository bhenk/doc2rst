<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the uses tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &uses [file | "FQSEN"] [<description>]
 * ```
 */
class UsesTag extends AbstractTypeTag {

    /**
     * @inheritdoc
     */
    const TAG = "@uses";

    public function getTagName(): string {
        return self::TAG;
    }
}