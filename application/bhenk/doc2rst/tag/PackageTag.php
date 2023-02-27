<?php

namespace bhenk\doc2rst\tag;

use function addslashes;

class PackageTag extends AbstractTag {

    const TAG = "@package";

    private ?string $subdivision;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the package tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &package [level 1]\[level 2]\[etc.]
     * ```
     *
     * @return string
     */
    public function render(): string {
        $this->subdivision = addslashes($this->getLine());
        return $this->subdivision;
    }

    /**
     *
     * @return string|null
     * @package PHP\documentation\tags
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