<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\CodeBlock;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Table;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\tag\ReturnTag;
use bhenk\doc2rst\work\ProcessState;
use bhenk\doc2rst\work\TypeLinker;
use ReflectionFunction;
use function count;
use function implode;
use function is_null;

class FunctionLexer extends AbstractLexer {

    function __construct(private readonly ReflectionFunction $function,
                         private readonly string             $fq_classname,
                         private readonly string             $shortname
    ) {
        $this->lex();
    }

    public function lex(): void {
        $label = $this->fq_classname . "::" . $this->function->getShortName();
        $title = $this->shortname . "::" . $this->function->getShortName();
        $this->addSegment(new Label($label));
        $this->addSegment(new Title($title, 2));
        $predicates = $this->getPredicates();
        if (!empty($predicates)) {
            $table = new Table(2);
            $table->addRow("predicates", implode(" | ", $predicates));
            $this->addSegment($table);
        }
        $lexer = new CommentLexer($this->function->getDocComment());
        $lexer->getCommentOrganizer()->setSignature($this->createCodeBlock());
        $this->checkParameters($lexer, $this->function->getParameters());

        // @return
        $doc_returns = $lexer->getCommentOrganizer()->removeTagsByName(ReturnTag::TAG);
        if (count($doc_returns) > 1)
            Log::warning("More than one @return tag -> " . ProcessState::getPointer());
        $return_tag = $doc_returns[0] ?? new ReturnTag();
        $type = null;
        if (!is_null($this->function->getReturnType()))
            $type = TypeLinker::resolveReflectionType($this->function->getReturnType());
        $return_tag->setType($type);
        $lexer->getCommentOrganizer()->addTag($return_tag);

        $this->addSegment($lexer);
        $lexer->getCommentOrganizer()->render();
    }

    private function getPredicates(): array {
        $predicates = [];
        if ($this->function->isStatic()) $predicates[] = "static";
        if ($this->function->isClosure()) $predicates[] = "closure";
        return $predicates;
    }

    private function createFunctionSignature(): array {
        $static = $this->function->isStatic() ? "static " : "";
        $closure = $this->function->isClosure() ? "closure" : "";
        $function = "function ";

        $dot = "";
        $types = "";
        if (!is_null($this->function->getReturnType())) {
            $dot = ": ";
            $types = $this->resolveReflectionType($this->function->getReturnType());
        }
        return [$static . $closure . $function
            . $this->function->name . "(", ")" . $dot . $types];
    }

    private function createCodeBlock(): CodeBlock {
        $ms = $this->createFunctionSignature();
        $line = $ms[0];
        if (!empty($this->function->getParameters())) $line .= PHP_EOL;
        foreach ($this->function->getParameters() as $param) {
            $line .= "         " . $param->__toString() . PHP_EOL;
        }
        $line .= empty($this->function->getParameters()) ? $ms[1] . PHP_EOL : "    " . $ms[1] . PHP_EOL;
        $cb = new CodeBlock();
        $cb->addLine($line);
        return $cb;
    }


}