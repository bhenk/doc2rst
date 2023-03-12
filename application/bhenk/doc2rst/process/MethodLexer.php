<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\CodeBlock;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Table;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\tag\ReturnTag;
use bhenk\doc2rst\work\TypeLinker;
use ReflectionException;
use ReflectionMethod;
use function implode;
use function is_null;

class MethodLexer extends AbstractLexer {

    function __construct(private readonly ?ReflectionMethod $method) {
        if (!is_null($this->method)) {
            ProcessState::setCurrentMethod($this->method);
            $this->lex();
            ProcessState::setCurrentMethod(null);
        }
    }

    public function lex(): void {
        $rc = ProcessState::getCurrentClass();
        $label = $rc->name . "::" . $this->method->name;
        $title = $rc->getShortName() . "::" . $this->method->name;
        $this->addSegment(new Label($label));
        $this->addSegment(new Title($title, 2));

        $table = new Table(2);

        // qualifiers
        $table->addRow("predicates", implode(" | ", $this->getPredicates()));

        // implements
        try {
            // before PHP 8.2 no method ReflectionMethod::hasPrototype.
            $prototype = $this->method->getPrototype();
            $table->addRow("implements", TypeLinker::resolveFQCN($prototype->getDeclaringClass(), $prototype));
        } catch (ReflectionException) {
        }

        // inherited from
        $declaringClass = $this->method->getDeclaringClass();
        if ($declaringClass->getName() != $rc->getName() and !$declaringClass->isInterface()) {
            $table->addRow("inherited from", TypeLinker::resolveFQCN($declaringClass, $this->method));
        }

        $this->addSegment($table);

        // comment
        $lexer = new CommentLexer($this->method->getDocComment());
        $lexer->getCommentOrganizer()->setSignature($this->createCodeBlock());

        // @params
        $this->checkParameters($lexer, $this->method->getParameters());

        // @return
        $doc_returns = $lexer->getCommentOrganizer()->removeTagsByName(ReturnTag::TAG);
        if (count($doc_returns) > 1)
            Log::warning("More than one @return tag -> " . ProcessState::getCurrentFile());
        if (!$this->method->isConstructor()) {
            $return_tag = $doc_returns[0] ?? new ReturnTag();
            $type = null;
            if (!is_null($this->method->getReturnType())) {
                $type = TypeLinker::resolveReflectionType($this->method->getReturnType());
                $return_tag->setType($type);
                $lexer->getCommentOrganizer()->addTag($return_tag);
            }
        }

        $this->addSegment($lexer);
        $lexer->getCommentOrganizer()->render();
    }

    private function getPredicates(): array {
        $predicates = [];
        $predicates[] = $this->method->isPublic() ? "public" :
            ($this->method->isProtected() ? "protected" : "private");
        if ($this->method->isStatic()) $predicates[] = "static";
        if ($this->method->isAbstract()) $predicates[] = "abstract";
        if ($this->method->isFinal()) $predicates[] = "final";
        if ($this->method->isConstructor()) $predicates[] = "constructor";
        return $predicates;
    }

    private function createMethodSignature(): array {
        $access = $this->method->isPublic() ? "public " : ($this->method->isProtected() ? "protected " : "private ");
        $static = $this->method->isStatic() ? "static " : "";
        $abstract = $this->method->isAbstract() ? "abstract " : "";
        $final = $this->method->isFinal() ? "final " : "";
        $function = "function ";

        $dot = "";
        $types = "";
        if (!is_null($this->method->getReturnType())) {
            $dot = ": ";
            $types = $this->resolveReflectionType($this->method->getReturnType());
        }
        return [$access . $static . $abstract . $final . $function
            . $this->method->name . "(", ")" . $dot . $types];
    }

    /**
     * @return CodeBlock
     */
    private function createCodeBlock(): CodeBlock {
        $ms = $this->createMethodSignature();
        $line = $ms[0];
        if (!empty($this->method->getParameters())) $line .= PHP_EOL;
        foreach ($this->method->getParameters() as $param) {
            $line .= "         " . $param->__toString() . PHP_EOL;
        }
        $line .= empty($this->method->getParameters()) ? $ms[1] . PHP_EOL : "    " . $ms[1] . PHP_EOL;
        $cb = new CodeBlock();
        $cb->addLine($line);
        return $cb;
    }

}