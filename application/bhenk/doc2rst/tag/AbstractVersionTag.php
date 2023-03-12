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

    /**
     * Renders a versioned Tag
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    .. code-block::
     *
     *       &tag_name [<"Semantic Version">] [<description>]
     * ```
     *
     * Renders [<"Semantic Version">] as is, transforms inline PHPDoc tags in [<description>] to their
     * reStructuredText representation.
     * @inheritdoc
     * @return void
     */
    public function render(): void {
        $things = explode(" ", $this->getLine(), 2);
        $this->semantic_version = $things[0] ?? null;
        $this->setDescription(TagFactory::resolveTags($things[1] ?? ""));
    }

    /**
     * Returns a reStructuredText representation of the contents of this Tag
     * @return string reStructuredText representation of contents
     */
    public function __toString(): string {
        return trim($this->semantic_version . " " . $this->getDescription());
    }

    /**
     * Get the [<"Semantic Version">]
     *
     * @return string|null
     */
    public function getSemanticVersion(): ?string {
        return $this->semantic_version;
    }

    /**
     * Set the [<"Semantic Version">]
     *
     * @param string $semantic_version
     */
    public function setSemanticVersion(string $semantic_version): void {
        $this->semantic_version = $semantic_version;
    }
}