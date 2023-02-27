<?php

namespace bhenk\doc2rst\tag;

use function explode;
use function trim;

class SinceTag extends AbstractTag {

    const TAG = "@since";

    private ?string $semantic_version;
    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the since tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &since [<"Semantic Version">] [<description>]
     * ```
     *
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 2);
        $this->semantic_version = $things[0] ?? null;
        $this->description = $things[1] ?? null;
        return trim($this->semantic_version . " " . $this->description);
    }

    /**
     *
     * @return string|null
     * @since 0.0
     */
    public function getSemanticVersion(): ?string {
        return $this->semantic_version;
    }

    /**
     * @param string|null $semantic_version
     */
    public function setSemanticVersion(?string $semantic_version): void {
        $this->semantic_version = $semantic_version;
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