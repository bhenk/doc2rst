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