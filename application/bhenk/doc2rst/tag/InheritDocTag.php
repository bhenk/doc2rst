<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\globals\TypeLinker;
use bhenk\doc2rst\process\CommentLexer;
use ReflectionException;

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
                $lexer = new CommentLexer($proto->getDocComment());
                $lexer->getCommentOrganizer()->setIndented(true);
                $this->setDescription(PHP_EOL . $lexer . PHP_EOL);
            } catch (ReflectionException) {
                $this->setDescription("undefined (no prototype)");
            }
        } elseif ($class) {
            if ($class->getParentClass() and !empty($class->getParentClass()->getDocComment())) {
                $parent = $class->getParentClass();
                $lexer = new CommentLexer($parent->getDocComment());
                $lexer->getCommentOrganizer()->setIndented(true);
                $this->setDescription(PHP_EOL . $lexer . PHP_EOL);
            } elseif (!empty($class->getInterfaces())) {
                foreach ($class->getInterfaces() as $interface) {
                    if ($interface->getDocComment() and !empty($interface->getDocComment())) {
                        $lexer = new CommentLexer($interface->getDocComment());
                        $lexer->getCommentOrganizer()->setIndented(true);
                        $line = "``@inheritDoc`` from " . TypeLinker::resolveFQCN($interface);
                        $this->setDescription(PHP_EOL . $lexer . $line . PHP_EOL);
                        break;
                    }
                }
                if (empty($this->description))
                    $this->setDescription("No DocComment found");
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