<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\SourceState;
use bhenk\doc2rst\rst\Table;
use bhenk\doc2rst\work\TypeLinker;
use ReflectionClass;
use ReflectionException;
use function addslashes;
use function count;
use function implode;
use function str_replace;
use function substr;

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

        $subs = $this->findSubClassesAndImplementations();
        if (!empty($subs[1])) {
            $table->addRow("known implementations", implode(" | ", $subs[1]));
        }
        if (!empty($subs[0])) {
            $table->addRow("known subclasses", implode(" | ", $subs[0]));
        }
        $this->addSegment($table);

        $lexer = new CommentLexer($this->class->getDocComment());

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

    private function findSubClassesAndImplementations(): array {
        $subClasses = [];
        $implementations = [];
        foreach (SourceState::getPhpFiles() as $rel_path) {
            $fqcn = substr(str_replace("/", "\\", $rel_path), 0, -4);
            try {
                $maybeClass = new ReflectionClass($fqcn);
                if ($maybeClass->getParentClass()
                    and $maybeClass->getParentClass()->getName() == $this->class->getName()) {
                    $subClasses[] = TypeLinker::createDocumentedClassReference($maybeClass);
                }
                foreach ($maybeClass->getInterfaces() as $interface) {
                    if ($interface->getName() == $this->class->getName()) {
                        $implementations[] = TypeLinker::createDocumentedClassReference($maybeClass);
                    }
                }
            } catch (ReflectionException) {
            }
        }
        return [$subClasses, $implementations];
    }


}