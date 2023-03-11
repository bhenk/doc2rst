<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\TypeLinker;
use bhenk\doc2rst\process\CommentLexer;
use ReflectionClass;
use ReflectionException;
use function in_array;

/**
 * Represents the inheritDoc tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &inheritDoc
 *       {&inheritDoc}
 * ```
 */
class InheritDocTag extends AbstractSimpleTag {

    const TAG = "@inheritDoc";

    private static array $reportedClasses = [];

    public static function resetReportedClasses(): void {
        self::$reportedClasses = [];
    }

    private static function addReportedClass(ReflectionClass $reportedClass) {
        self::$reportedClasses[] = $reportedClass->getName();
    }

    public function getTagName(): string {
        return self::TAG;
    }

    public function render(): void {
        $method = ProcessState::getCurrentMethod();
        $class = ProcessState::getCurrentClass();
        $this->description = "";
        if ($method) {
            try {
                $proto = $method->getPrototype();
                $lexer = new CommentLexer($proto->getDocComment(), true);
                $lexer->getCommentOrganizer()->setIndented(true);
                $line = "``@inheritDoc`` from " . TypeLinker::resolveFQCN($proto->getDeclaringClass(), $method);
                $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);
            } catch (ReflectionException) {
                $this->setDescription("undefined (no prototype)");
            }
        } elseif ($class) {
            if ($class->getParentClass()
                and !in_array($class->getParentClass()->getName(), self::$reportedClasses)
                and !empty($class->getParentClass()->getDocComment())) {

                $parent = $class->getParentClass();
                self::addReportedClass($parent);
                $lexer = new CommentLexer($parent->getDocComment(), true);
                $lexer->getCommentOrganizer()->setIndented(true);
                $line = "``@inheritDoc`` from " . TypeLinker::resolveFQCN($parent);
                $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);

            } elseif (!empty($class->getInterfaces())) {
                foreach ($class->getInterfaces() as $interface) {
                    if ($interface->getDocComment()
                        and !in_array($interface->getName(), self::$reportedClasses)
                        and !empty($interface->getDocComment())) {

                        self::addReportedClass($interface);
                        $lexer = new CommentLexer($interface->getDocComment(), true);
                        $lexer->getCommentOrganizer()->setIndented(true);
                        $line = "``@inheritDoc`` from " . TypeLinker::resolveFQCN($interface);
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
}