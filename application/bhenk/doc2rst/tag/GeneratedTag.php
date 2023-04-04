<?php /** @noinspection PhpUnused */

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
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#55-generated PSR-19 @\ generated
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