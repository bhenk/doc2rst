<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\model\ReaderInterface;
use ReflectionClass;
use ReflectionMethod;
use function is_null;
use function str_repeat;
use function strlen;

class ConstructorReader implements ReaderInterface {

    public function render(ReflectionClass $rc): string {
        $s = "";
        $constructor = $rc->getConstructor();
        if (is_null($constructor)) return $s;

        $title = $rc->getShortName() . "::__construct";
        $s .= PHP_EOL . ".. _" . $rc->name . "::__construct:" . PHP_EOL . PHP_EOL;
        $s .= $title
            . PHP_EOL
            . str_repeat("~", strlen($title))
            . PHP_EOL . PHP_EOL;

//        if ($constructor->isAbstract()) $s .= " | ``Abstract`` ";
//        if ($constructor->isFinal()) $s .= " | ``Final`` ";
//        if ($constructor->isClosure()) $s .= " | ``Closure`` ";
//        if ($constructor->isDeprecated()) $s .= " | ``Deprecated`` ";
//        if ($constructor->isGenerator()) $s .= " | ``Generator`` ";
//        if ($constructor->isVariadic()) $s .= " | ``Variadic`` ";

        $s .= $this->makeFunction($constructor);

        $docCommentEditor = new DocCommentEditor();
        $s .= $docCommentEditor->readDoc($constructor->getDocComment());

        return $s;
    }

    private function makeFunction(ReflectionMethod $constructor): string {
        // public function __construct(string $x, int $y)
        $s = ".. code-block:: php" . PHP_EOL . PHP_EOL;
        $p = $constructor->isPublic() ? "public " : ($constructor->isProtected() ? "protected " : "private ");
        $s .= "    " . $p . "function __construct(" . PHP_EOL;
        foreach ($constructor->getParameters() as $param) {
            $s .= "         " . $param->__toString() . PHP_EOL;
        }
        $s .= "    )" . PHP_EOL . PHP_EOL;
        return $s;
    }
}