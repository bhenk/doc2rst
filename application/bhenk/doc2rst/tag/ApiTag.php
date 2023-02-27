<?php

namespace bhenk\doc2rst\tag;

class ApiTag extends AbstractTag {

    const TAG = "@api";

    /**
     *
     * @return string
     * @api
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
     *    &api
     * ```
     *
     * @return string
     */
    public function render(): string {
        return "";
    }
}