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

    public function render(): void {
        $this->description = TagFactory::resolveTags($this->getLine());
    }

    public function __toString(): string {
        if (!isset($this->description)) {
            $this->render();
        }
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        if (!isset($this->description)) {
            $this->render();
            if (!isset($this->description)) {
                $this->description = "Foo";
            }
        }
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
    }
}