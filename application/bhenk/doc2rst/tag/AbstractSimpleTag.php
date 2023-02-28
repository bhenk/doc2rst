<?php

namespace bhenk\doc2rst\tag;

/**
 * Abstract tag that handles <description> syntax.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &tag_name <description>
 * ```
 */
abstract class AbstractSimpleTag extends AbstractTag {

    private ?string $description;

    public function render(): string {
        $this->description = $this->getLine();
        return $this->description;
    }

    /**
     * @return string|null
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