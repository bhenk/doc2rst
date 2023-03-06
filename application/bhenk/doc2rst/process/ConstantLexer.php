<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\TypeLinker;
use bhenk\doc2rst\rst\CodeBlock;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Table;
use bhenk\doc2rst\rst\Title;
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

        $table = new Table(2);
        // qualifiers
        $table->addRow("predicates", implode(" | ", $this->getPredicates()));

        // inherited from
        $declaringClass = $this->constant->getDeclaringClass();
        if ($declaringClass->getName() != $rc->getName()) {
            $table->addRow("Inherited from", TypeLinker::resolveFQCN($declaringClass, $this->constant));
        }
        $this->addSegment($table);
        $this->addSegment(PHP_EOL);


        // comment
        $lexer = new CommentLexer($this->constant->getDocComment());
        $this->addSegment($lexer);
        $lexer->getCommentOrganizer()->render();
        $this->addSegment($this->createCodeBlock());

        $this->addSegment(PHP_EOL);


    }

    private function getPredicates(): array {
        $qualifiers = [];
        $qualifiers[] = $this->constant->isPublic() ? "public" :
            ($this->constant->isProtected() ? "protected" : "private");
        if ($this->constant->isFinal()) $qualifiers[] = "final";
        if ($this->constant->isEnumCase()) $qualifiers[] = "enum case";
        return $qualifiers;
    }

    private function createCodeBlock(): CodeBlock {
        $val = $this->constant->getValue();

        ob_start();
        var_dump($val);
        $val = ob_get_contents();
        ob_end_clean();

        $val = str_replace(PHP_EOL, " ", $val);
        $val = preg_replace("/\s+/", " ", $val);
        $val = mb_strimwidth($val, 0, 90, " ...");
        $val = str_replace("\033", "\\033", $val);

        $cb = new CodeBlock();
        $cb->addLine($val);
        return $cb;
    }

}