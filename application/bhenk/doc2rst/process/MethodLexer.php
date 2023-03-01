<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\LinkUtil;
use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\CodeBlock;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\tag\ParamTag;
use bhenk\doc2rst\tag\ReturnTag;
use ReflectionException;
use ReflectionMethod;
use Throwable;
use function array_key_exists;
use function implode;
use function is_null;
use function method_exists;
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

        // qualifiers
        $this->addSegment("| ``" . implode("`` | ``", $this->getQualifiers()) . "``");

        // implements
        try {
            // before PHP 8.2 no method ReflectionMethod::hasPrototype.
            $prototype = $this->method->getPrototype();
            $content = $prototype->getDeclaringClass()->getName() . "::" . $prototype->getName() . "()";
            $this->addSegment("| ``Implements`` "
                . LinkUtil::renderLink($content, $content));
        } catch (ReflectionException $e) {
        }

        // inherited from
        $declaringClass = $this->method->getDeclaringClass();
        if ($declaringClass->getName() != $rc->getName() and !$declaringClass->isInterface()) {
            $content = $declaringClass->getName() . "::" . $this->method->getName() . "()";
            $this->addSegment("| ``Inherited from`` "
                . LinkUtil::renderLink($content, $content));
        }
        $this->addSegment(PHP_EOL);

        // comment
        $lexer = new CommentLexer($this->method);
        $lexer->getCommentOrganizer()->setSignature($this->createCodeBlock());
        $this->addSegment($lexer);

        // @params
        $doc_params = [];
        /** @var ParamTag $param */
        foreach ($lexer->getCommentOrganizer()->getTagsByName(ParamTag::TAG) as $param) {
            $doc_params[$param->getName()] = $param;
        }
        $params = $this->method->getParameters();
        foreach ($params as $param) {
            if (!array_key_exists("$" . $param->getName(), $doc_params)) {
                //$allows_null = $param->getType()->allowsNull() ? "?" : "";
                $line = ParamTag::TAG . " " . $param->getType() . " $" . $param->getName();
                $lexer->getCommentOrganizer()->addTag(new ParamTag($line));
            }
        }

        // unrelated @param tags in documentation.
        if ($this->method->getFileName() == ProcessState::getCurrentClass()->getFileName()) {
            foreach ($doc_params as $name => $tag) {
                $found = false;
                foreach ($params as $param) {
                    if ("$" . $param->getName() == $name) $found = true;
                }
                if (!$found) {
                    Log::warning("Unknown parameter: " . $tag . " -> " . ProcessState::getCurrentFile());
                }
            }
        }

        // @return
        $doc_returns = $lexer->getCommentOrganizer()->getTagsByName(ReturnTag::TAG);
        if (count($doc_returns) > 1)
            Log::warning("More than one @return tag -> " . ProcessState::getCurrentFile());
        /** @var ReturnTag $doc_return */
        $doc_return = $doc_returns[0] ?? null;

        $return_type = $this->method->getReturnType();
        if ($return_type) {
            $type = null;
            if (method_exists($return_type, "getName")) {
                $allows_null = $return_type->allowsNull() ? "?" : "";
                $type = $allows_null . $return_type->getName();
            }
            if (method_exists($return_type, "getTypes")) {
                $types = [];
                foreach ($return_type->getTypes() as $thing) {
                    $an = $thing->allowsNull() ? "?" : "";
                    $types[] = $an . $thing->getName();
                }
                $type = implode("|", $types);
            }
            if ($doc_return and $type) {
                $doc_return->setType($type);
            } else {
                $line = ReturnTag::TAG . " " . $type;
                $lexer->getCommentOrganizer()->addTag(new ReturnTag($line));
            }
        }


        $lexer->getCommentOrganizer()->render();

    }

    private function getQualifiers(): array {
        $qualifiers = [];
        $qualifiers[] = $this->method->isPublic() ? "public" :
            ($this->method->isProtected() ? "protected" : "private");
        if ($this->method->isStatic()) $qualifiers[] = "static";
        if ($this->method->isAbstract()) $qualifiers[] = "abstract";
        if ($this->method->isFinal()) $qualifiers[] = "final";
        if ($this->method->isConstructor()) $qualifiers[] = "constructor";
        return $qualifiers;
    }

    private function createMethodSignature(): array {
        $access = $this->method->isPublic() ? "public " : ($this->method->isProtected() ? "protected " : "private ");
        $static = $this->method->isStatic() ? "static " : "";
        $abstract = $this->method->isAbstract() ? "abstract " : "";
        $final = $this->method->isFinal() ? "final " : "";
        $function = "function ";

        $dot = "";
        $question_mark = "";
        $types = "";
        if (!is_null($this->method->getReturnType())) {
            $rt = $this->method->getReturnType();
            $dot = ": ";
            $question_mark = $rt->allowsNull() ? "?" : "";

            try {

                $types = str_replace("\\", "",
                    substr($rt->getName(), strrpos($rt->getName(), "\\", -1)));
            } catch (Throwable $e) {
                $types_array = [];
                foreach ($rt->getTypes() as $type) {
                    $types_array[] = str_replace("\\", "", substr($type->getName(),
                        strrpos($type->getName(), "\\", -1)));
                }
                $types = implode(" | ", $types_array);
            }
        }
        return [$access . $static . $abstract . $final . $function
            . $this->method->name . "(", ")" . $dot . $question_mark . $types];
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