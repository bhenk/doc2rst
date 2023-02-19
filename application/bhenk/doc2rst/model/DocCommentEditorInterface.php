<?php

namespace bhenk\doc2rst\model;

interface DocCommentEditorInterface {

    public function readDoc(string $doc): string;

}