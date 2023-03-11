<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the var tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &var ["Type"] [element_name] [<description>]
 * ```
 */
class VarTag extends ParamTag {

    /**
     * @inheritdoc
     */
    const TAG = "@var";

    public function getTagName(): string {
        return self::TAG;
    }

}