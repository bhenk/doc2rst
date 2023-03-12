<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the inheritdoc tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &inheritdoc
 *       {&inheritdoc}
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#41-making-inheritance-explicit-using-the-inheritdoc-tag PSR-19 @\ inheritDoc
 */
class InheritdocTag extends AbstractSimpleTag {

    /**
     * @inheritdoc
     */
    const TAG = "@inheritdoc";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Returns a reStructuredText representation of inherited PHPDoc
     *
     * If no inherited PHPDoc can be found, returns a placeholder string.
     *
     * @return string reStructuredText representation of inherited PHPDoc
     */
    public function __toString(): string {
        return $this->getDescription();
    }

}