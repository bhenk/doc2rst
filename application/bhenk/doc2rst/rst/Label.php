<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;

class Label implements Stringable {

    public function __construct(private string $label_name) {}


    /**
     *
     */
    public function __toString(): string {
        // .. _my-reference-label:
        return PHP_EOL . ".. _" . $this->label_name . ":" . PHP_EOL;
    }

    /**
     * @return string
     * @noinspection PhpUnused
     */
    public function getLabelName(): string {
        return $this->label_name;
    }

    /**
     * @param string $label_name
     * @noinspection PhpUnused
     */
    public function setLabelName(string $label_name): void {
        $this->label_name = $label_name;
    }

}