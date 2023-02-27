<?php

namespace bhenk\doc2rst\tag;

use function explode;

class DeprecatedTag extends AbstractTag {

    const TAG = "@deprecated";

    private ?string $semantic_version;
    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the deprecated tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &deprecated [<"Semantic Version">] [<description>]
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
     * @return string
     */
    public function getSemanticVersion(): string {
        return $this->semantic_version;
    }

    /**
     * @param string $semantic_version
     */
    public function setSemanticVersion(string $semantic_version): void {
        $this->semantic_version = $semantic_version;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->description = $description;
    }
}