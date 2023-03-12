<?php

namespace bhenk\doc2rst\tag;

interface TagInterface {

    /**
     * Express this Tag in reStructuredText
     *
     * @return string reStructuredText representation of this Tag
     */
    public function toRst(): string;

    /**
     * Gets the tag-name of this Tag
     *
     * @return string tag-name of this Tag
     */
    public function getTagName(): string;

    /**
     * Get the short version of this tagname, without the at-sign (@)
     *
     * @return string short version of this tagname
     */
    public function getDisplayName(): string;

    /**
     * Is this an inline tag
     *
     * Is this an inline tag (with curly braces) or does this tag appear at the start of a line.
     * @return bool *true* if this is an inline link, *false* otherwise
     */
    public function isInline(): bool;

    /**
     * Get the length (in characters) of this tagname.
     *
     * @return int length (in characters) of this tagname
     */
    public function getTagLength(): int;

    /**
     * Get the width (in characters) of the group in which this Tag will be displayed
     *
     * @return int width (in characters) or -1 if not yet set
     */
    public function getGroupWidth(): int;

    /**
     * Set the width (in characters) of the group in which this Tag will be displayed
     *
     * @param int $max_width width (in characters)
     * @return void
     */
    public function setGroupWidth(int $max_width): void;

}