<?php

namespace bhenk\doc2rst\tag;

use function explode;
use function str_starts_with;
use function trim;

class ReturnTag extends AbstractTag {

    const TAG = "@return";

    private ?string $type;
    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the return tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &return <"Type"> [description]
     * ```
     *
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 2);
        $this->type = $things[0] ?? null;
        $this->description = $things[1] ?? null;
        $this->type = self::resolveType($this->type);
        if ($this->description and !str_starts_with($this->description, "- ")) $this->description = "- " . $this->description;
        return trim($this->type . " " . " " . $this->description);
    }

    /**
     * @return string|null
     */
    public function getType(): ?string {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void {
        $this->type = $type;
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