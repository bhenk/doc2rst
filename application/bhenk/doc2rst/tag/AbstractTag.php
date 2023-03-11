<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\tag;

use bhenk\doc2rst\globals\D2R;
use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\log\Log;
use Stringable;
use function max;
use function str_starts_with;
use function strlen;
use function substr;

/**
 * Abstract base class for tags.
 */
abstract class AbstractTag implements Stringable {

    /** @var string TAG the name of this tag */
    const TAG = "@name_of_tag";

    private int $tag_length;
    private int $group_width = -1;

    /**
     * Construct a new Tag.
     *
     * The {@link $tag_string} should include the at-symbol (@), tag name and possibly curly braces.
     * The string should follow the syntax of the specific Tag being constructed.
     *
     * @param string|null $tag_string string following syntax of **this** Tag class
     */
    function __construct(protected ?string $tag_string = "") {
        $this->tag_length = strlen($this->getTagName()) - 1;
        $this->render();
    }

    /**
     * Get the $tag_string
     *
     * @return string string with which **this** Tag was constructed
     */
    public function getTagString(): string {
        return $this->tag_string;
    }

    /**
     * Render the $tag_string
     *
     * Upon this command subclasses should parse the $tag_string.
     *
     * @return void
     */
    protected abstract function render(): void;

    /**
     * Get the content of the $tag_string without the tag name and curly braces
     * @return string content of the $tag_string
     */
    public function getLine(): string {
        if ($this->isInline()) {
            return substr($this->tag_string, strlen(static::getTagName()) + 2, -1);
        } else {
            return substr($this->tag_string, strlen(static::getTagName()) + 1);
        }
    }

    /**
     * Gets the tag-name of this Tag
     *
     * @return string tag-name of this Tag
     */
    public abstract function getTagName(): string;

    /**
     * Get the short version of this tagname, without the at-sign (@)
     *
     * @return string short version of this tagname
     */
    public function getDisplayName(): string {
        return substr($this->getTagName(), 1);
    }

    /**
     * Is this an inline link
     *
     * Is this an inline link (with curly braces) or does this tag appear at the start of a line.
     * @return bool *true* if this is an inline link, *false* otherwise
     */
    public function isInline(): bool {
        return str_starts_with($this->tag_string, "{@");
    }

    /**
     * Get the length (in characters) of this tagname.
     * @return int length (in characters) of this tagname
     */
    public function getTagLength(): int {
        return $this->tag_length;
    }

    /**
     * Get the width (in characters) of the group in which this Tag will be displayed
     * @return int width (in characters) or -1 if not yet set
     */
    public function getGroupWidth(): int {
        return $this->group_width;
    }

    /**
     * Set the width (in characters) of the group in which this Tag will be displayed
     * @param int $max_width width (in characters)
     * @return void
     */
    public function setGroupWidth(int $max_width): void {
        $this->group_width = $max_width;
    }

    /**
     * Express this Tag in reStructuredText
     *
     *
     * @return string reStructuredText representation of this Tag
     */
    public function toRst(): string {
        $style = D2R::getTagStyle($this->getTagName());
        if ($style == "" or $this->isInline()) {
            return $this->toPlainRst();
        } else {
            return $this->toStyledRst();
        }
    }

    private function getRole(): string {
        if ($this->isInline()) return "tag0";
        $max = max($this->tag_length, $this->group_width);
        if ($max <= 12 and $max >= 3) return "tag" . $max;
        return "tag0";
    }

    private function toPlainRst(): string {
        if ($this->isInline()) {
            $prefix = ($this->getTagName() == "@link") ? "" : ":tag0:`" . $this->getTagName() . "` ";
            return $prefix . $this->__toString();
        }
        return "| :" . $this->getRole() . ":`" . $this->getDisplayName() . "` " . $this->__toString() . PHP_EOL;
    }

    private function toStyledRst(): string {
        $style = D2R::getTagStyle($this->getTagName());
        $argument = "";
        $tagName = "**" . $this->getTagName() . "** ";
        if (str_starts_with($style, "admonition")) {
            $argument = substr($style, 10);
            $style = "admonition";
            if (empty($argument)) {
                $argument = $this->getTagName();
            }
        }
        if ($argument != "") $tagName = "";
        $content_block = $tagName . $this->__toString();
        if (empty($content_block)) {
            $content_block = "**" . $this->getTagName() . "** ";
            Log::warning("Styled " . $this->getTagName() . " tag without content: "
                . ProcessState::getCurrentFile());
        }

        $s = PHP_EOL . ".. " . $style . ":: " . $argument . PHP_EOL . PHP_EOL;
        $s .= "    " . $content_block . PHP_EOL . PHP_EOL;
        return $s;
    }

}