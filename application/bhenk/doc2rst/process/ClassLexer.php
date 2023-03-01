<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\LinkUtil;
use ReflectionClass;
use function count;
use function implode;

class ClassLexer extends AbstractLexer {

    function __construct(private readonly ReflectionClass $class) {
        $this->lex();
    }

    public function lex(): void {
        $s = "| ``" . $this->class->getNamespaceName() . "``";
        if ($this->class->isAbstract()) $s .= " | ``Abstract`` ";
        if ($this->class->isFinal()) $s .= " | ``Final`` ";
        if ($this->class->isAnonymous()) $s .= " | ``Anonymous`` ";
        // if ($this->class->isReadOnly()) $s .= " | ``ReadOnly`` ";  // PHP 8.2
        if ($this->class->isCloneable()) $s .= " | ``Cloneable``"; // (nearly) every class is cloneable
        if ($this->class->isIterable()) $s .= " | ``Iterable`` ";
        if ($this->class->isInterface()) $s .= " | ``Interface`` ";
        if ($this->class->isEnum()) $s .= " | ``Enum`` ";
        if ($this->class->isTrait()) $s .= " | ``Trait`` ";
        $this->addSegment($s);


        $names = $this->class->getInterfaceNames();
        if (!empty($names)) {
            $this->addSegment("| **implements:** " . implode(" | ", $this->linkForName($names)));
        }

        $parent = $this->class->getParentClass();
        if ($parent) {
            $this->addSegment("| **extends:** " . LinkUtil::renderLink($parent->name));
        }

        $traits = $this->class->getTraitNames();
        if ($traits) {
            $this->addSegment("| **uses:** " . implode(" | ", $this->linkForName($traits)));
        }

        $hierarchy = $this->getHierarchy();
        if (count($hierarchy) > 1) {
            $this->addSegment("| **hierarchy:** " . implode(" -> ", $this->linkForName($hierarchy)));
        }

        $this->addSegment(PHP_EOL);

        $lexer = new CommentLexer($this->class);
        $this->addSegment($lexer->getCommentOrganizer()->render());
    }

    private function linkForName(array $names): array {
        $links = [];
        foreach ($names as $name) {
            $links[] = LinkUtil::renderLink($name);
        }
        return $links;
    }

    private function getHierarchy(): array {
        $hierarchy = [];
        $parent = $this->class;
        while ($parent) {
            $hierarchy[] = $parent->name;
            $parent = $parent->getParentClass();
        }
        return $hierarchy;
    }


}