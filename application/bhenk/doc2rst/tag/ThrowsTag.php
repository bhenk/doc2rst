<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the throws tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &throws ["Type"] [<description>]
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#515-throws PSR-19 @\ throws
 */
class ThrowsTag extends AbstractTypeTag {

    /**
     * @inheritdoc
     */
    const TAG = "@throws";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

}