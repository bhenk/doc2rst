<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the see tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &see [URI | "FQSEN"] [<description>]
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#513-see PSR-19 @\ see
 */
class SeeTag extends AbstractLinkTag {

    /**
     * @inheritdoc
     */
    const TAG = "@see";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

}