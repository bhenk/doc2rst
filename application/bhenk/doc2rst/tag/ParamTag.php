<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\work\Linker;
use function explode;
use function is_null;
use function trim;

/**
 * Represents the param tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &param ["Type"] $[name] [<description>]
 * ```
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#510-param PSR-19 @\ param
 */
class ParamTag extends AbstractTypeTag {

    /**
     * @inheritdoc
     */
    const TAG = "@param";

    private ?string $name;

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders a named type Tag
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    .. code-block::
     *
     *       &tag_name ["Type"] $[name] [<description>]
     * ```
     *
     */
    public function render(): void {
        $things = explode(" ", $this->getLine(), 3);
        $type = $things[0] ?? null;
        $this->name = $things[1] ?? null;
        $this->setDescription(TagFactory::resolveTags($things[2] ?? ""));
        $this->setType(Linker::getLink($type));
    }

    /**
     * Returns a reStructuredText representation of the contents of this Tag
     * @return string reStructuredText representation of contents
     */
    public function __toString(): string {
        $name = is_null($this->name) ? null : " :param:`" . $this->name . "` ";
        $desc = $this->getDescription();
        if ($desc and !str_starts_with($desc, "- ")) $desc = "- " . $desc;
        return trim($this->getType() . $name . $desc);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void {
        $this->name = $name;
    }

}