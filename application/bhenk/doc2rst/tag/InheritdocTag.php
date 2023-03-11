<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\TypeLinker;
use bhenk\doc2rst\process\CommentLexer;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;
use function in_array;
use function str_contains;
use function strtolower;

/**
 * Represents the inheritdoc tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &inheritdoc
 *       {&inheritdoc}
 * ```
 */
class InheritdocTag extends AbstractSimpleTag {

    /**
     * @inheritdoc
     */
    const TAG = "@inheritdoc";

    private static array $reportedClasses = [];

    public static function resetReportedClasses(): void {
        self::$reportedClasses = [];
    }

    private static function addReportedClass(ReflectionClass $reportedClass, string $member = null) {
        $mena = $member ? "::" . $member : "";
        self::$reportedClasses[] = $reportedClass->getName() . $mena;
    }

    public function getTagName(): string {
        return self::TAG;
    }

    public function render(): void {
        $constant = ProcessState::getCurrentConstant();
        $method = ProcessState::getCurrentMethod();
        $class = ProcessState::getCurrentClass();
        $this->description = "";
        if ($method) {
            try {
                $proto = $method->getPrototype();
                $lexer = new CommentLexer($proto->getDocComment(), true);
                $lexer->getCommentOrganizer()->setIndented(true);
                $line = "``@inheritdoc`` from " . TypeLinker::resolveFQCN($proto->getDeclaringClass(), $method);
                $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);
            } catch (ReflectionException) {
                $this->setDescription("undefined (no prototype)");
            }
        } elseif ($constant) {
            $proto = $this->getProtoConstant($constant);
            if ($proto) {
                self::addReportedClass($proto->getDeclaringClass(), $proto->getName());
                $lexer = new CommentLexer($proto->getDocComment(), true);
                $lexer->getCommentOrganizer()->setIndented(true);
                $line = "``@inheritdoc`` from " . TypeLinker::resolveFQCN($proto->getDeclaringClass(), $constant);
                $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);
            } else {
                $this->setDescription("No proto constant found with DocComments");
            }
        } elseif ($class) {
            if ($class->getParentClass()
                and !in_array($class->getParentClass()->getName(), self::$reportedClasses)
                and !empty($class->getParentClass()->getDocComment())) {

                $parent = $class->getParentClass();
                self::addReportedClass($parent);
                $lexer = new CommentLexer($parent->getDocComment(), true);
                $lexer->getCommentOrganizer()->setIndented(true);
                $line = "``@inheritdoc`` from " . TypeLinker::resolveFQCN($parent);
                $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);

            } elseif (!empty($class->getInterfaces())) {
                foreach ($class->getInterfaces() as $interface) {
                    if ($interface->getDocComment()
                        and !in_array($interface->getName(), self::$reportedClasses)
                        and !empty($interface->getDocComment())) {

                        self::addReportedClass($interface);
                        $lexer = new CommentLexer($interface->getDocComment(), true);
                        $lexer->getCommentOrganizer()->setIndented(true);
                        $line = "``@inheritdoc`` from " . TypeLinker::resolveFQCN($interface);
                        $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);
                        break;
                    }
                }
                if (empty($this->description))
                    $this->setDescription("No more inherited DocComments found on **this** class");
            }
        } else {
            $this->setDescription("undefined");
        }
    }

    public function __toString(): string {
        if (!isset($this->description)) {
            $this->render();
        }
        return $this->getDescription();
    }

    private function getProtoConstant(ReflectionClassConstant $constant): ReflectionClassConstant|bool {
        $parent = $constant->getDeclaringClass()->getParentClass();
        if ($parent) {
            $parent_const = $parent->getReflectionConstant($constant->getName());
            if ($parent_const
                and $parent_const->getDocComment()
                and !in_array($constant->getDeclaringClass()->getName()
                    . "::" . $constant->getName(), self::$reportedClasses)
                and (!str_contains(strtolower($parent_const->getDocComment()), "@inheritdoc"))) {

                return $parent_const;
            } else {
                return $this->getProtoConstant($parent_const);
            }
        }
        return false;
    }
}