<?php

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

    public function __toString(): string {
        return "";
    }
}