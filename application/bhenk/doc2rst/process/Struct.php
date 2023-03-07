<?php

namespace bhenk\doc2rst\process;

use function gettype;
use function substr_count;

class Struct {

    function __construct(
        private readonly int     $line,
        private readonly ?string $name = null,
        private readonly mixed   $value = null,
        private readonly int     $doc_comment_start = -1,
        private readonly ?string $doc_comment = null
    ) {}

    /**
     * @return int
     */
    public function getLine(): int {
        return $this->line;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed {
        return $this->value;
    }

    public function getType(): string {
        return gettype($this->value);
    }

    /**
     * @return string|null
     */
    public function getDocComment(): ?string {
        return $this->doc_comment;
    }

    /**
     * @return int
     */
    public function getDocCommentStart(): int {
        return $this->doc_comment_start;
    }

    public function getDocCommentEnd(): int {
        if ($this->doc_comment_start <= 0) return -1;
        return $this->doc_comment_start + substr_count($this->doc_comment, PHP_EOL);
    }

    public function getDocCommentDistance(): int {
        if ($this->doc_comment_start <= 0) return -1;
        return $this->line - $this->getDocCommentEnd();
    }

}