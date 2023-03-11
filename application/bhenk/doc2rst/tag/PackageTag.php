<?php

namespace bhenk\doc2rst\tag;

use function addslashes;

/**
 * Represents the package tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &package [level 1]\[level 2]\[etc.]
 * ```
 */
class PackageTag extends AbstractTag {

    /**
     * @inheritdoc
     */
    const TAG = "@package";

    private ?string $subdivision;

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the package tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    .. code-block::
     *
     *       &package [level 1]\[level 2]\[etc.]
     * ```
     *
     * @return string
     */
    public function render(): void {
        $this->subdivision = addslashes($this->getLine());
    }

    public function __toString(): string {
        return $this->subdivision;
    }

    /**
     *
     * @return string|null
     */
    public function getSubdivision(): ?string {
        return $this->subdivision;
    }

    /**
     * @param string|null $subdivision
     */
    public function setSubdivision(?string $subdivision): void {
        $this->subdivision = $subdivision;
    }
}