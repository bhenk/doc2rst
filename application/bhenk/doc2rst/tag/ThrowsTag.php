<?php

namespace bhenk\doc2rst\tag;

class ThrowsTag extends AbstractTag {

    const TAG = "@throws";

    public function getTagName(): string {
        return self::TAG;
    }

    public function render(): string {
        return "ToDo: " . self::class;
    }
}