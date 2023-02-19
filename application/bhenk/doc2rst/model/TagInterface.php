<?php

namespace bhenk\doc2rst\model;

interface TagInterface {

    public function render(string $tag): string;

}