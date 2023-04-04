<?php /** @noinspection PhpUnused */

namespace bhenk\doc2rst\tag;

/**
 * Represents the api tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &api
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#51-api PSR-19 @\ api
 */
class ApiTag extends AbstractTag {

    /**
     * @inheritdoc
     */
    const TAG = "@api";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the api tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    .. code-block::
     *
     *       &api
     * ```
     *
     */
    public function render(): void {}

    /**
     * Returns a reStructuredText representation of the contents of this Tag
     *
     * (which is always the empty string "")
     * @return string reStructuredText representation of contents
     */
    public function __toString(): string {
        return "";
    }
}