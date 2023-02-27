<?php

namespace bhenk\doc2rst\tag;

class CopyrightTag extends AbstractTag {

    const TAG = "@copyright";

    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the copyright tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &copyright <description>
     * ```
     *
     * @return string
     */
    public function render(): string {
        $this->description = $this->getLine();
        return $this->description;
    }

    /**
     *
     * @return string|null
     * @copyright hvdb
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
    }
}