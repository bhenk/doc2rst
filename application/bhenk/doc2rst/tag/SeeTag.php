<?php

namespace bhenk\doc2rst\tag;

class SeeTag extends AbstractTag {

    const TAG = "@see";

    public function getTagName(): string {
        return self::TAG;
    }

    public function render(): string {
        return self::renderLink($this->getLine());
    }
}