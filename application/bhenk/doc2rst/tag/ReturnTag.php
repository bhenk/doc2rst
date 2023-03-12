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
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#512-return PSR-19 @\ return
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