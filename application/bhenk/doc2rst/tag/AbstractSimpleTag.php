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

    protected ?string $description;

    /**
     * Renders the description of simple tags.
     * @inheritdoc
     * @return void
     * @uses TagFactory::resolveTags
     */
    public function render(): void {
        $this->description = TagFactory::resolveTags($this->getLine());
    }

    /**
     * Returns a reStructuredText representation of the contents of this Tag
     * @return string reStructuredText representation of contents
     */
    public function __toString(): string {
        if (!isset($this->description)) {
            $this->render();
        }
        return $this->description;
    }

    /**
     * Get the <description>
     *
     * @return string|null
     */
    public function getDescription(): ?string {
        if (!isset($this->description)) {
            $this->render();
        }
        return $this->description;
    }

    /**
     * Set the <description>
     *
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
    }
}