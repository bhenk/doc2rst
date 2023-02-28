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

    const TAG = "@api";

    /**
     *
     * @return string
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
     * @return string
     */
    public function render(): string {
        return "";
    }
}