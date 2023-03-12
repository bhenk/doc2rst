<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

/**
 * Represents the link tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &link [URI] [description]
 *       {&link [URI] [description]}
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#57-link PSR-19 @\ link
 */
class LinkTag extends AbstractLinkTag {

    /**
     * @inheritdoc
     */
    const TAG = "@link";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

}