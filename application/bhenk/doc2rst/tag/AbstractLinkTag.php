<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\LinkUtil;
use function explode;

/**
 * Abstract tag that handles [URI|FQSEN] [description] syntax.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &tag_name [URI|FQSEN] [description]
 *       {&tag_name [URI|FQSEN] [description]}
 * ```
 */
abstract class AbstractLinkTag extends AbstractTag {

    private ?string $uri;
    private ?string $description;

    /**
     * Renders the tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    .. code-block::
     *
     *       &tag_name [URI] [description]
     *       {&tag_name [URI] [description]}
     * ```
     *
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 2);
        $this->uri = $things[0] ?? null;
        $this->description = $things[1] ?? null;
        return LinkUtil::renderLink($this->uri, $this->description);
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