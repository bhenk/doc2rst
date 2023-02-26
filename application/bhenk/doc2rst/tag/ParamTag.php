<?php /** @noinspection PhpVarTagWithoutVariableNameInspection */

namespace bhenk\doc2rst\tag;

use function explode;

class ParamTag extends AbstractTag {

    const TAG = "@param";

    private ?string $type;
    private ?string $name;
    private ?string $desc;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the @param tag.
     *
     * .. admonition:: syntax
     *
     * @param ["Type"] $[name] [<description>]
     *
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 3);
        $this->type = $things[0] ?? null;
        $this->name = $things[1] ?? null;
        $this->desc = $things[2] ?? null;

        $this->type = self::resolveType($this->type);
        return trim($this->type . " ``" . $this->name . "`` " . $this->desc);
    }

    /**
     * @return string|null
     */
    public function getType(): ?string {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDesc(): ?string {
        return $this->desc;
    }
}