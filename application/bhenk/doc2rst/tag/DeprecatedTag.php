<?php /** @noinspection PhpUnused */

namespace bhenk\doc2rst\tag;

/**
 * Represents the deprecated tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &deprecated [<"Semantic Version">] [<description>]
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#54-deprecated PSR-19 @\ deprecated
 */
class DeprecatedTag extends AbstractVersionTag {

    /**
     * @inheritdoc
     */
    const TAG = "@deprecated";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }
}