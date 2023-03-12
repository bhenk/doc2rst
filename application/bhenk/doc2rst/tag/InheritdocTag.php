<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\process\CommentLexer;
use bhenk\doc2rst\work\TypeLinker;
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
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#41-making-inheritance-explicit-using-the-inheritdoc-tag PSR-19 @\ inheritDoc
 */
class InheritdocTag extends AbstractSimpleTag {

    /**
     * @inheritdoc
     */
    const TAG = "@inheritdoc";

    private static array $reportedClasses = [];

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
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
                if ($proto->getDocComment()) {
                    $lexer = new CommentLexer($proto->getDocComment(), true);
                    $lexer->getCommentOrganizer()->setIndented(true);
                    $line = "``@inheritdoc`` from method "
                        . TypeLinker::resolveFQCN($proto->getDeclaringClass(), $method);
                    $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);
                } else {
                    $this->setDescription("No DocComment found on method "
                        . TypeLinker::resolveFQCN($proto->getDeclaringClass(), $method));
                }
            } catch (ReflectionException) {
                $this->setDescription("undefined (no prototype with DocComment)");
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
                $line = "``@inheritdoc`` from class " . TypeLinker::resolveFQCN($parent);
                $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);

            } elseif (!empty($class->getInterfaces())) {
                foreach ($class->getInterfaces() as $interface) {
                    if ($interface->getDocComment()
                        and !in_array($interface->getName(), self::$reportedClasses)
                        and !empty($interface->getDocComment())) {

                        self::addReportedClass($interface);
                        $lexer = new CommentLexer($interface->getDocComment(), true);
                        $lexer->getCommentOrganizer()->setIndented(true);
                        $line = "``@inheritdoc`` from interface " . TypeLinker::resolveFQCN($interface);
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

    /**
     * Returns a reStructuredText representation of inherited PHPDoc
     *
     * If no inherited PHPDoc can be found, returns a placeholder string.
     *
     * @return string reStructuredText representation of inherited PHPDoc
     */
    public function __toString(): string {
        if (!isset($this->description)) {
            $this->render();
        }
        return $this->getDescription();
    }

    public static function resetReportedClasses(): void {
        self::$reportedClasses = [];
    }

    private static function addReportedClass(ReflectionClass $reportedClass, string $member = null) {
        $mena = $member ? "::" . $member : "";
        self::$reportedClasses[] = $reportedClass->getName() . $mena;
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