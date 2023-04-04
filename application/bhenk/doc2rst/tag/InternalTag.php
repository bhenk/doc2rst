<?php /** @noinspection PhpUnused */

namespace bhenk\doc2rst\tag;

/**
 * Represents the internal tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &internal [description]
 *       {&internal [description]}
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#56-internal PSR-19 @\ internal
 */
class InternalTag extends AbstractSimpleTag {

    /**
     * @inheritdoc
     */
    const TAG = "@internal";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

}