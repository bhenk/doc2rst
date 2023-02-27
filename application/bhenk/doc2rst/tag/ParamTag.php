<?php

namespace bhenk\doc2rst\tag;

use function explode;

class ParamTag extends AbstractTag {

    const TAG = "@param";

    private ?string $type;
    private ?string $name;
    private ?string $description;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the param tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &param ["Type"] $[name] [<description>]
     * ```
     *
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 3);
        $this->type = $things[0] ?? null;
        $this->name = $things[1] ?? null;
        $this->description = $things[2] ?? null;

        $this->type = self::resolveType($this->type);
        return trim($this->type . " ``" . $this->name . "`` " . $this->description);
    }

    /**
     *
     *
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
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void {
        $this->name = $name;
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