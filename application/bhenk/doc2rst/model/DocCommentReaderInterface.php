<?php

namespace bhenk\doc2rst\model;

interface DocCommentReaderInterface {

    public function readDoc(string $doc): string;

}