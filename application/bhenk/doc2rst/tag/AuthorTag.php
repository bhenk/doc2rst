<?php /** @noinspection PhpUnused */

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
 * @see https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md#52-author PSR-19 @\ author
 */
class AuthorTag extends AbstractTag {

    /**
     * @inheritdoc
     */
    const TAG = "@author";

    private ?string $name;
    private ?string $email;

    /**
     * @inheritdoc
     * @return string name of this Tag
     */
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

    /**
     * Returns a reStructuredText representation of the contents of this Tag
     * @return string reStructuredText representation of contents
     */
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