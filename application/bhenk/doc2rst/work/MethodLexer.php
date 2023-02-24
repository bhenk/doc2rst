<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\rst\CodeBlock;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Title;
use bhenk\doc2rst\tag\LinkTag;
use ReflectionMethod;
use Stringable;
use Throwable;
use function implode;
use function is_null;
use function str_replace;
use function strrpos;
use function substr;

class MethodLexer implements Stringable {

    private array $segments = [];

    function __construct(private readonly ?ReflectionMethod $method) {
        if (!is_null($this->method)) {
            $this->lex();
        }
    }

    public function lex(): void {
        $rc = ProcessState::getCurrentClass();
        $this->addSegment(new Label($rc->name . "::" . $this->method->name));
        $ms = $this->getMethodSignature(false);
        $this->addSegment(new Title($ms[0] . $ms[1], 2));

        $declaringClass = $this->method->getDeclaringClass();
        if ($declaringClass->getName() != $rc->getName())
            $this->addSegment("**Inherited from** "
                . LinkTag::renderLink($declaringClass->getName() . PHP_EOL));

        $this->addSegment($this->createCodeBlock());


    }

    public function __toString(): string {
        return implode(PHP_EOL, $this->segments);
    }

    /**
     * @return array
     */
    public function getSegments(): array {
        return $this->segments;
    }

    /**
     * @param array $segments
     */
    public function setSegments(array $segments): void {
        $this->segments = $segments;
    }

    public function addSegment(Stringable|string $segment): void {
        $this->segments[] = $segment;
    }

    private function getMethodSignature(bool $with_function = true): array {
        $access = $this->method->isPublic() ? "public " : ($this->method->isProtected() ? "protected " : "private ");
        $static = $this->method->isStatic() ? "static " : "";
        $abstract = $this->method->isAbstract() ? "abstract " : "";
        $final = $this->method->isFinal() ? "final " : "";
        $function = $with_function ? "function " : "";

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
        $ms = $this->getMethodSignature();
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