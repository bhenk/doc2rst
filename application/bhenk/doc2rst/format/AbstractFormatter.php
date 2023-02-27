<?php

namespace bhenk\doc2rst\format;

use bhenk\doc2rst\process\CommentOrganizer;

abstract class AbstractFormatter {

    private int $line_count = 0;

    function __construct(private readonly CommentOrganizer $organizer) {}

    /**
     * @return CommentOrganizer
     */
    public function getOrganizer(): CommentOrganizer {
        return $this->organizer;
    }

    public abstract function handleLine(string $line): bool;

    /**
     * @return int
     */
    public function getLineCount(): int {
        return $this->line_count;
    }

    public function increaseLineCount(): int {
        return $this->line_count++;
    }

}