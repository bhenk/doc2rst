<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\rst\CodeBlock;
use bhenk\doc2rst\rst\Label;
use bhenk\doc2rst\rst\Title;
use ReflectionMethod;
use Stringable;
use function implode;
use function is_null;

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
        $this->addSegment(new Title($rc->getShortName() . "::" . $this->method->name, 1));

        $line = $this->method->isPublic() ? "public "
            : ($this->method->isProtected() ? "protected " : "private ");
        $line .= "function " . $this->method->name . "(";
        if (!empty($this->method->getParameters())) $line .= PHP_EOL;
        foreach ($this->method->getParameters() as $param) {
            $line .= "         " . $param->__toString() . PHP_EOL;
        }
        $line .= "    )" . PHP_EOL;
        $cb = new CodeBlock();
        $cb->addLine($line);
        $this->addSegment($cb);
        //$this->addSegment(PHP_EOL);
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

}