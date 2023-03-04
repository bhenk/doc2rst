<?php

namespace bhenk\doc2rst\tag;

use function str_replace;
use function trim;

/**
 * Represents the author tag.
 *
 * ```rst replace & @
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       &author [name] [<email address>]
 * ```
 */
class AuthorTag extends AbstractTag {

    const TAG = "@author";

    private ?string $name;
    private ?string $email;

    public function getTagName(): string {
        return self::TAG;
    }

    /**
     * Renders the author tag.
     *
     * ```rst replace & @
     * .. admonition:: syntax
     *
     *    .. code-block::
     *
     *       &author [name] [<email address>]
     * ```
     *
     */
    public function render(): void {
        $line = $this->getLine();
        $pattern = '/[a-z0-9_\-]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
        preg_match_all($pattern, $line, $matches);
        $this->email = $matches[0][0] ?? "";
        $this->name = trim(str_replace($this->email, "", $line));
    }

    public function __toString(): string {
        return trim($this->name . " " . $this->email);
    }

    /**
     *
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
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void {
        $this->email = $email;
    }
}