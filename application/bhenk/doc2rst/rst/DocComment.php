<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;
use function implode;

class DocComment implements Stringable {

    private const NL2 = PHP_EOL . PHP_EOL;

    private string $description = "";
    private array $lines = [];
    private array $links = [];
    private array $sees = [];
    private array $params = [];
    private array $throws = [];
    private string $return = "";

    function __construct() {}

    /**
     * @inheritDoc
     */
    public function __toString(): string {
        $s = "";
        if (!empty($this->description)) $s .= trim($this->description) . self::NL2;
        if (!empty($this->lines))
            $s .= implode(PHP_EOL, $this->lines) . PHP_EOL . PHP_EOL;
        $nl = false;
        foreach ($this->links as $link) {
            $s .= "| **@link:** " . $link . PHP_EOL;
            $nl = true;
        }
        foreach ($this->sees as $see) {
            $s .= "| **@see also:** " . $see . PHP_EOL;
            $nl = true;
        }
        if ($nl) $s .= PHP_EOL;
        foreach ($this->params as $param) {
            $s .= "| **@param:** " . $param . PHP_EOL;
        }
        foreach ($this->throws as $throw) {
            $s .= "| **@throws:** " . $throw . PHP_EOL;
        }
        if (!empty($this->return)) $s .= "| **returns:** " . $this->return . PHP_EOL;
        $s .= PHP_EOL;
        return $s;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param Stringable $description
     */
    public function setDescription(Stringable|string $description): void {
        $this->description = $description;
    }

    public function addDescription(Stringable|string $part) {
        $this->description .= $part . " ";
    }

    /**
     * @return array
     */
    public function getLines(): array {
        return $this->lines;
    }

    /**
     * @param array $lines
     */
    public function setLines(array $lines): void {
        $this->lines = $lines;
    }

    public function addLine(Stringable|string $line): void {
        $this->lines[] = $line;
    }

    /**
     * @return array
     */
    public function getLinks(): array {
        return $this->links;
    }

    /**
     * @param array $links
     */
    public function setLinks(array $links): void {
        $this->links = $links;
    }

    public function addLink(Stringable|string $link): void {
        $this->links[] = $link;
    }

    /**
     * @return array
     */
    public function getSees(): array {
        return $this->sees;
    }

    /**
     * @param array $sees
     */
    public function setSees(array $sees): void {
        $this->sees = $sees;
    }

    public function addSee(Stringable|string $see): void {
        $this->sees[] = $see;
    }

    /**
     * @return array
     */
    public function getParams(): array {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void {
        $this->params = $params;
    }

    public function addParam(Stringable|string $param): void {
        $this->params[] = $param;
    }

    /**
     * @return array
     */
    public function getThrows(): array {
        return $this->throws;
    }

    /**
     * @param array $throws
     */
    public function setThrows(array $throws): void {
        $this->throws = $throws;
    }

    public function addThrows(Stringable|string $throw): void {
        $this->throws[] = $throw;
    }

    /**
     * @return string
     */
    public function getReturn(): string {
        return $this->return;
    }

    /**
     * @param Stringable|string $return
     */
    public function setReturn(Stringable|string $return): void {
        $this->return = $return;
    }
}