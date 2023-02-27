<?php

namespace bhenk\doc2rst\tag;

use function explode;
use function trim;

class ThrowsTag extends AbstractTag {

    const TAG = "@throws";

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the throws tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    &throws ["Type"] [<description>]
     * ```
     *
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 2);
        $type = $things[0] ?? null;
        $desc = $things[1] ?? null;
        $type = self::resolveType($type);
        if ($desc and !str_starts_with($desc, "- ")) $desc = "- " . $desc;
        return trim($type . " " . " " . $desc);
    }
}