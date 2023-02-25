<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

class LinkTag extends AbstractTag {

    const TAG = "@link";

    public function getTagName(): string {
        return self::TAG;
    }

    public function render(): string {
        return self::renderLink($this->getLine());
    }

}