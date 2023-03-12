<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\Linker;
use function explode;
use function trim;

/**
 * Abstract tag that handles <"Type"> [description] syntax.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &tag_name <"Type"> [description]
 * ```
 */
abstract class AbstractTypeTag extends AbstractLinkTag {

    /**
     * Renders a typed tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    .. code-block::
     *
     *       &tag_name <"Type"> [description]
     * ```
     *
     */
    public function render(): void {
        $things = explode(" ", $this->getLine(), 2);
        $type = $things[0] ?? null;
        $this->setDescription(TagFactory::resolveTags($things[1] ?? ""));
        $this->setUri(Linker::getLink($type));
    }

    /**
     * Returns a reStructuredText representation of the contents of this Tag
     * @return string reStructuredText representation of contents
     */
    public function __toString(): string {
        $desc = $this->getDescription();
        if ($desc and !str_starts_with($desc, "- ")) $desc = "- " . $desc;
        return trim($this->getUri() . " " . " " . $desc);
    }

    /**
     * @return string|null
     */
    public function getType(): ?string {
        return $this->getUri();
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void {
        $this->setUri($type);
    }

}