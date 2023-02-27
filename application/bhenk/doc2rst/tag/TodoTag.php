<?php

namespace bhenk\doc2rst\tag;

class TodoTag extends AbstractTag {

    const TAG = "@todo";

    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the todo tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &todo [description]
     * ```
     *
     * @return string
     */
    public function render(): string {
        $this->description = $this->getLine();
        return $this->description;
    }

    /**
     * @return string|null
     * @todo show the tag
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