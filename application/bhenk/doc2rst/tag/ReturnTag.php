<?php

namespace bhenk\doc2rst\tag;

use function explode;
use function str_starts_with;
use function trim;

class ReturnTag extends AbstractTag {

    const TAG = "@return";

    private ?string $type;
    private ?string $desc;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the @return tag.
     *
     * .. admonition:: syntax
     *
     * @return <"Type"> [description]
     *
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 2);
        $this->type = $things[0] ?? null;
        $this->desc = $things[1] ?? null;
        $this->type = self::resolveType($this->type);
        if ($this->desc and !str_starts_with($this->desc, "- ")) $this->desc = "- " . $this->desc;
        return trim($this->type . " " . " " . $this->desc);
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
    public function getDesc(): ?string {
        return $this->desc;
    }
}