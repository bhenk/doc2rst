<?php

namespace bhenk\doc2rst\tag;

use function explode;

class SeeTag extends AbstractTag {

    const TAG = "@see";

    private ?string $uri;
    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the see tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &see [URI | "FQSEN"] [<description>]
     * ```
     *
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 2);
        $this->uri = $things[0] ?? null;
        $this->description = $things[1] ?? null;
        return self::renderLink($this->uri, $this->description);
    }

    /**
     * @return string|null
     */
    public function getUri(): ?string {
        return $this->uri;
    }

    /**
     * @param string|null $uri
     */
    public function setUri(?string $uri): void {
        $this->uri = $uri;
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