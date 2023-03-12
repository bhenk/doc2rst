<?php

namespace bhenk\doc2rst\format;

use RuntimeException;
use function is_null;
use function str_replace;
use function str_starts_with;

class RestructuredTextFormatter extends AbstractFormatter {

    private ?string $command = null;

    public function handleLine(string $line): bool {
        // ```rst replace $ @
        if ($this->getLineCount() == 0) $this->getOrganizer()->addLine(PHP_EOL);
        $lc = $this->increaseLineCount();

        if ($lc == 0) {
            $parts = explode(" ", $line, 2);
            $this->command = $parts[1] ?? null;
            return true;
        }

        if (str_starts_with($line, "```")) {
            return false;
        }

        if (!is_null($this->command)) {
            if (str_starts_with($this->command, "replace")) {
                $things = explode(" ", $this->command);
                if (count($things) < 3) throw new RuntimeException(
                    "Insufficient parameters: " . $this->command);
                $line = str_replace($things[1], $things[2], $line);
            }
        }
        $this->getOrganizer()->addLine($line);
        return true;
    }
}