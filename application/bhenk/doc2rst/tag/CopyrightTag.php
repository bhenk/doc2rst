<?php

namespace bhenk\doc2rst\tag;

/**
 * Represents the copyright tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &copyright <description>
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#53-copyright PSR-19 @\ copyright
 */
class CopyrightTag extends AbstractSimpleTag {

    /**
     * @inheritdoc
     */
    const TAG = "@copyright";

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

}