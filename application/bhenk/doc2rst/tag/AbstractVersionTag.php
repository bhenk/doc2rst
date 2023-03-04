<?php

namespace bhenk\doc2rst\tag;

use function explode;
use function trim;

/**
 * Abstract tag that handles [<"Semantic Version">] [<description>] syntax.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &tag_name [<"Semantic Version">] [<description>]
 * ```
 */
abstract class AbstractVersionTag extends AbstractSimpleTag {

    private ?string $semantic_version;

    public function render(): void {
        $things = explode(" ", $this->getLine(), 2);
        $this->semantic_version = $things[0] ?? null;
        $this->setDescription($things[1] ?? null);
    }

    public function __toString(): string {
        return trim($this->semantic_version . " " . $this->getDescription());
    }

    /**
     * @return string|null
     */
    public function getSemanticVersion(): ?string {
        return $this->semantic_version;
    }

    /**
     * @param string|null $semantic_version
     */
    public function setSemanticVersion(?string $semantic_version): void {
        $this->semantic_version = $semantic_version;
    }
}