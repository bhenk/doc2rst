<?php

namespace bhenk\doc2rst\tag;

interface TagInterface {

    public function render(string $tag): string;

}