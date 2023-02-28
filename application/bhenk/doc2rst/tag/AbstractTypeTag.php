<?php

namespace bhenk\doc2rst\tag;

use function explode;
use function implode;
use function substr;
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
     * @return string
     */
    public function render(): string {
        $things = explode(" ", $this->getLine(), 2);
        $type = $things[0] ?? null;
        $this->setDescription($things[1] ?? null);
        $this->setUri(self::resolveType($type));

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


    public static function resolveType($type): string {
        if ($type) {
            $arr = [];
            $types = explode("|", $type);
            foreach ($types as $search) {
                $prefix = "";
                if (str_starts_with($search, "?")) {
                    $search = substr($search, 1);
                    $prefix = "?\ ";
                }
                $arr[] = $prefix . self::renderLink($search, null, false);
            }
            $type = implode(" | ", $arr);
        }
        return $type;
    }
}