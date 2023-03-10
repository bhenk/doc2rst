<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\log\Log;
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
        if ($method) {
            try {
                $proto = $method->getPrototype();
                $lexer = new CommentLexer($proto->getDocComment());
                $this->setDescription(PHP_EOL . $lexer . PHP_EOL);
            } catch (ReflectionException) {
                $this->setDescription("undefined (no prototype)");
            }
        } else {
            $this->setDescription("undefined");
        }
    }

    public function __toString(): string {
        return $this->getDescription();
    }
}