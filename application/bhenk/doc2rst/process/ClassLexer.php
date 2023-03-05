<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\TypeLinker;
use bhenk\doc2rst\rst\Table;
use ReflectionClass;
use function addslashes;
use function count;
use function implode;

class ClassLexer extends AbstractLexer {

    function __construct(private readonly ReflectionClass $class) {
        $this->lex();
    }

    public function lex(): void {
        $predicates = [];
        if ($this->class->isAbstract()) $predicates[] = "Abstract";
        if ($this->class->isFinal()) $predicates[] = "Final";
        if ($this->class->isAnonymous()) $predicates[] = "Anonymous";
        //if ($this->class->isReadOnly()) $predicates[] = "ReadOnly"; // PHP 8.2
        if ($this->class->isCloneable()) $predicates[] = "Cloneable";
        if ($this->class->isIterable()) $predicates[] = "Iterable";
        if ($this->class->isInterface()) $predicates[] = "Interface";
        if ($this->class->isEnum()) $predicates[] = "Enum";
        if ($this->class->isTrait()) $predicates[] = "Trait";
        if ($this->class->isInstantiable()) $predicates[] = "Instantiable";

        $table = new Table(2);
        $table->addRow("namespace", addslashes($this->class->getNamespaceName()));

        if (!empty($predicates)) {
            $table->addRow("predicates", implode(" | ", $predicates));
        }

        $interfaces = $this->class->getInterfaces();
        if (!empty($interfaces)) {
            $table->addRow("implements", implode(" | ", TypeLinker::resolveMultipleFQCN($interfaces)));
        }

        $parent = $this->class->getParentClass();
        if ($parent) {
            $table->addRow("extends", TypeLinker::resolveFQCN($parent));
        }

        $traits = $this->class->getTraits();
        if (!empty($traits)) {
            $table->addRow("uses", implode(" | ", TypeLinker::resolveMultipleFQCN($traits)));
        }

        $hierarchy = $this->getHierarchy();
        if (count($hierarchy) > 1) {
            $table->addRow("hierarchy", implode(" -> ", TypeLinker::resolveMultipleFQCN($hierarchy)));
        }
        $this->addSegment($table);

        $lexer = new CommentLexer($this->class);
        $this->addSegment($lexer->getCommentOrganizer()->render());
    }

    private function getHierarchy(): array {
        $hierarchy = [];
        $parent = $this->class;
        while ($parent) {
            $hierarchy[] = $parent;
            $parent = $parent->getParentClass();
        }
        return $hierarchy;
    }


}