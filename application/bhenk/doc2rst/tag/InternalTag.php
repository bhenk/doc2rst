<?php

namespace bhenk\doc2rst\tag;

class InternalTag extends AbstractTag {

    const TAG = "@internal";

    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the internal tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    | &internal [description]
     *    | {\&internal [description]}
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
     * @internal
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