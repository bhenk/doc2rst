<?php

namespace bhenk\doc2rst\tag;

class ReturnTag extends AbstractTag {

    const TAG = "@return";

    public function getTagName(): string {
        return self::TAG;
    }

    public function render(): string {
        return "ToDo: " . self::class;
    }
}