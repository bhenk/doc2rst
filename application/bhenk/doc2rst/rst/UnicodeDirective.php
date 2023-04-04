<?php /** @noinspection PhpUnused */

/** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\rst;

use Stringable;

class UnicodeDirective implements Stringable {

    function __construct(private readonly string  $alias,
                         private readonly string  $code,
                         private readonly bool    $trim = false,
                         private readonly ?string $comment = null) {}


    public function __toString(): string {
        $s = PHP_EOL . ".. |" . $this->alias . "| unicode:: " . $this->code;
        if ($this->comment) $s .= " .. " . $this->comment;
        $s .= PHP_EOL;
        if ($this->trim) $s .= "   :trim:" . PHP_EOL;
        $s .= PHP_EOL;
        return $s;
    }
}