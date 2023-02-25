<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use Stringable;
use function implode;

abstract class AbstractLexer implements Stringable {

    private array $segments = [];

    public function __toString(): string {
        return implode(PHP_EOL, $this->segments);
    }

    /**
     * @return array
     */
    public function getSegments(): array {
        return $this->segments;
    }

    /**
     * @param array $segments
     */
    public function setSegments(array $segments): void {
        $this->segments = $segments;
    }

    public function addSegment(Stringable|string $segment): void {
        $this->segments[] = $segment;
    }

}