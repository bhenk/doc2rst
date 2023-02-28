<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\rst\CodeBlock;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\tag\AbstractLinkTag;
use ReflectionClassConstant;
use function implode;
use function is_null;
use function preg_replace;
use function str_replace;
use function var_dump;

class ConstantLexer extends AbstractLexer {

    function __construct(private readonly ReflectionClassConstant $constant) {
        if (!is_null($this->constant)) {
            ProcessState::setCurrentConstant($this->constant);
            $this->lex();
            ProcessState::setCurrentConstant(null);
        }
    }

    public function lex(): void {
        $rc = ProcessState::getCurrentClass();
        $label = $rc->name . "::" . $this->constant->name;
        $title = $rc->getShortName() . "::" . $this->constant->name;
        $this->addSegment(new Label($label));
        $this->addSegment(new Title($title, 2));

        // qualifiers
        $line = "| ``" . implode("`` | ``", $this->getQualifiers()) . "``";
        // inherited from
        $declaringClass = $this->constant->getDeclaringClass();
        if ($declaringClass->getName() != $rc->getName()) {
            $content = $declaringClass->getName() . "::" . $this->constant->getName();
            $line .= " | ``Inherited from`` "
                . AbstractLinkTag::renderLink($content, $content);
        }
        $this->addSegment($line);
        $this->addSegment(PHP_EOL);

        $this->addSegment($this->createCodeBlock());

        // comment
        $lexer = new CommentLexer($this->constant);
        $this->addSegment($lexer);
        //$lexer->getCommentOrganizer()->setSignature($this->createCodeBlock());
        $lexer->getCommentOrganizer()->render();

        $this->addSegment(PHP_EOL);


    }

    private function getQualifiers(): array {
        $qualifiers = [];
        $qualifiers[] = $this->constant->isPublic() ? "public" :
            ($this->constant->isProtected() ? "protected" : "private");
        if ($this->constant->isFinal()) $qualifiers[] = "final";
        if ($this->constant->isEnumCase()) $qualifiers[] = "enum case";
        return $qualifiers;
    }

    private function createCodeBlock(): CodeBlock {
        $val = $this->constant->getValue();
//        $val = str_replace(PHP_EOL, " ", print_r($val, true));
//        $val = preg_replace("/\s+/", " ", $val);

        ob_start();
        var_dump($val);
        $val = ob_get_contents();
        ob_end_clean();

        $val = str_replace(PHP_EOL, " ", $val);
        $val = preg_replace("/\s+/", " ", $val);
        $val = mb_strimwidth($val, 0, 90, " ...");
        $val = str_replace("\033", "\\033", $val);
        //$val = str_replace("\n", "\\n", $val);

        $cb = new CodeBlock();
        $cb->addLine($val);
        return $cb;
    }

}