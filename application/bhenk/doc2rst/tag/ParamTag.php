<?php

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\Linker;
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
 */
class ParamTag extends AbstractTypeTag {

    /**
     * @inheritdoc
     */
    const TAG = "@param";

    private ?string $name;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the param tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    .. code-block::
     *
     *       &param ["Type"] $[name] [<description>]
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