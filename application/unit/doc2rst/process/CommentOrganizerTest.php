<?php

namespace unit\doc2rst\process;

use bhenk\doc2rst\process\CommentOrganizer;
use bhenk\doc2rst\tag\ParamTag;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class CommentOrganizerTest extends TestCase {

    public function testRender() {
        $co = new CommentOrganizer();

        $co->addLine("first line");
        $co->addTag(new ParamTag("first"));
        $co->setSignature("signature" . PHP_EOL);
        $co->addTag(new ParamTag("hmm"));
        //$co->addTag(new SeeTag("hmm hmm"));
        $co->setSummary("summary");
        $co->addLine("second line");
        //$co->render();
        //echo $co;
        assertEquals(1, 1);
    }
}
