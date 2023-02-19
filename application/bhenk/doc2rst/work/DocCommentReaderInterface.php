<?php

namespace bhenk\doc2rst\work;

interface DocCommentReaderInterface {

    public function readDoc(string $doc): string;

}