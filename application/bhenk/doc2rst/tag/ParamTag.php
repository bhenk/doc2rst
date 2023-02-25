<?php

namespace bhenk\doc2rst\tag;

class ParamTag extends AbstractTag {

    const TAG = "@param";

    public function getTagName(): string {
        return self::TAG;
    }

    public function render(): string {
        return "ToDo: " . self::class;
    }
}