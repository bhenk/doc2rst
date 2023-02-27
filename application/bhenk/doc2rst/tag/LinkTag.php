<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

use function explode;

class LinkTag extends AbstractTag {

    const TAG = "@link";

    private ?string $uri;
    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the link tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    | &link [URI] [description]
     *    | {\&link [URI] [description]}
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
     *
     * @link https://gitzw.art gitzwart
     *
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