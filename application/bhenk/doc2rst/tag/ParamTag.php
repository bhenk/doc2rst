<?php

namespace bhenk\doc2rst\tag;

use function explode;

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
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 3);
        $type = $things[0] ?? null;
        $this->name = $things[1] ?? null;
        $this->setDescription($things[2] ?? null);
        $this->setType(self::resolveType($type));

        return trim($this->getType() . " ``" . $this->name . "`` " . $this->getDescription());
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