<?php

namespace bhenk\doc2rst\format;

use function str_starts_with;

class CodeBlockFormatter extends AbstractFormatter {

    public function handleLine(string $line): bool {
        // ```
        $lc = $this->increaseLineCount();
        if ($lc == 0) {
            $line = PHP_EOL . "..  code-block::" . PHP_EOL;
            $this->getOrganizer()->addLine($line);
            return true;
        }
        if (str_starts_with($line, "```")) {
            $this->getOrganizer()->addLine(PHP_EOL);
            return false;
        }
        $line = "   " . $line;
        $this->getOrganizer()->addLine($line);
        return true;
    }
}