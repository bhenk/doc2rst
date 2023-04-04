<?php /** @noinspection PhpUnused */

namespace bhenk\doc2rst\tag;

/**
 * Represents the version tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &version [<"Semantic Version">] [<description>]
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#519-version PSR-19 @\ version
 */
class VersionTag extends AbstractVersionTag {

    /** @inheritdoc */
    const TAG = "@version";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }
}