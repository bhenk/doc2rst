<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\LinkUtil;
use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\CodeBlock;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Table;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\tag\ParamTag;
use bhenk\doc2rst\tag\ReturnTag;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionType;
use ReflectionUnionType;
use function implode;
use function is_null;
use function str_replace;
use function strrpos;
use function substr;

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
        $label = $rc->name . "::" . $this->method->name . "()";
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
            $content = $prototype->getDeclaringClass()->getName() . "::" . $prototype->getName() . "()";
            $table->addRow("implements", LinkUtil::renderLink($content, $content));
        } catch (ReflectionException) {
        }

        // inherited from
        $declaringClass = $this->method->getDeclaringClass();
        if ($declaringClass->getName() != $rc->getName() and !$declaringClass->isInterface()) {
            $content = $declaringClass->getName() . "::" . $this->method->getName() . "()";
            $table->addRow("Inherited from", LinkUtil::renderLink($content, $content));
        }

        $this->addSegment($table);

        // comment
        $lexer = new CommentLexer($this->method);
        $lexer->getCommentOrganizer()->setSignature($this->createCodeBlock());

        // @params
        $doc_params = [];
        /** @var ParamTag $param */
        foreach ($lexer->getCommentOrganizer()->removeTagsByName(ParamTag::TAG) as $param_tag) {
            $doc_params[$param_tag->getName()] = $param_tag;
        }
        $params = $this->method->getParameters();
        foreach ($params as $param) {
            $param_tag = $doc_params["$" . $param->getName()] ?? new ParamTag();
            $param_tag->setName("$" . $param->getName());
            $type = null;
            if (!is_null($param->getType())) // setTypeLess($foo) gives type == null.
                $type = LinkUtil::resolveReflectionType($param->getType());
            $param_tag->setType($type);
            $lexer->getCommentOrganizer()->addTag($param_tag);
        }

        // @return
        $doc_returns = $lexer->getCommentOrganizer()->removeTagsByName(ReturnTag::TAG);
        if (count($doc_returns) > 1)
            Log::warning("More than one @return tag -> " . ProcessState::getCurrentFile());
        if (!$this->method->isConstructor()) {
            $return_tag = $doc_returns[0] ?? new ReturnTag();
            $type = null;
            if (!is_null($this->method->getReturnType()))
                $type = LinkUtil::resolveReflectionType($this->method->getReturnType());
            $return_tag->setType($type);
            $lexer->getCommentOrganizer()->addTag($return_tag);
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

    private function resolveReflectionType(ReflectionType $reflectionType): string {
        if ($reflectionType instanceof ReflectionNamedType) {
            $name = str_replace("\\", "",
                substr($reflectionType->getName(), strrpos($reflectionType->getName(), "\\", -1)));
            $allowsNull = ($reflectionType->allowsNull() and ($name != "null") and ($name != "mixed")) ? "?" : "";
            return $allowsNull . $name;
        } elseif ($reflectionType instanceof ReflectionUnionType) {
            $results = [];
            foreach ($reflectionType->getTypes() as $reflectionNamedType) {
                $results[] = self::resolveReflectionType($reflectionNamedType);
            }
            return implode("|", $results);
        } else {
            Log::warning("Cannot handle " . $reflectionType::class);
            return "unknown";
        }
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