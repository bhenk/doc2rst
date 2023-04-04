<?php /** @noinspection PhpUnused */

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
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#517-uses PSR-19 @\ uses
 */
class UsesTag extends AbstractTypeTag {

    /**
     * @inheritdoc
     */
    const TAG = "@uses";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }
}