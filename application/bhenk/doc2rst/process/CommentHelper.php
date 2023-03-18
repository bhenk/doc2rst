<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\work\ProcessState;
use bhenk\doc2rst\work\TypeLinker;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionException;
use function in_array;
use function strtolower;

class CommentHelper {

    private static array $reportedClasses = [];

    private static function addReportedClass(ReflectionClass $reportedClass, string $member = null): void {
        $mena = $member ? "::" . $member : "";
        self::$reportedClasses[] = $reportedClass->getName() . $mena;
    }

    public static function resetReportedClasses(): void {
        self::$reportedClasses = [];
    }

    public function getInheritedComment(): string {
        $constant = ProcessState::getCurrentConstant();
        $method = ProcessState::getCurrentMethod();
        $class = ProcessState::getCurrentClass();

        if ($method) {
            try {
                $proto = $method->getPrototype();
                if ($proto->getDocComment()) {
                    $lexer = new CommentLexer($proto->getDocComment(), true);
                    $lexer->getCommentOrganizer()->setIndented(true);
                    $line = "``@inheritdoc`` from method "
                        . TypeLinker::resolveFQCN($proto->getDeclaringClass(), $method);
                    return PHP_EOL . $lexer . $line . PHP_EOL;
                } else {
                    return "No DocComment found on method "
                        . TypeLinker::resolveFQCN($proto->getDeclaringClass(), $method);
                }
            } catch (ReflectionException) {
                return "undefined (no prototype with DocComment)";
            }
        } elseif ($constant) {
            $proto = $this->getProtoConstant($constant);
            if ($proto) {
                self::addReportedClass($proto->getDeclaringClass(), $proto->getName());
                $lexer = new CommentLexer($proto->getDocComment(), true);
                $lexer->getCommentOrganizer()->setIndented(true);
                $line = "``@inheritdoc`` from " . TypeLinker::resolveFQCN($proto->getDeclaringClass(), $constant);
                return PHP_EOL . $lexer . $line . PHP_EOL;
            } else {
                return "No proto constant found with DocComments";
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
                return PHP_EOL . $lexer . $line . PHP_EOL;

            } elseif (!empty($class->getInterfaces())) {
                foreach ($class->getInterfaces() as $interface) {
                    if ($interface->getDocComment()
                        and !in_array($interface->getName(), self::$reportedClasses)
                        and !empty($interface->getDocComment())) {

                        self::addReportedClass($interface);
                        $lexer = new CommentLexer($interface->getDocComment(), true);
                        $lexer->getCommentOrganizer()->setIndented(true);
                        $line = "``@inheritdoc`` from interface " . TypeLinker::resolveFQCN($interface);
                        return PHP_EOL . $lexer . $line . PHP_EOL;
                    }
                }
            }
        } else {
            return "No more inherited DocComments found on parents or interfaces";
        }
        return "undefined";
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