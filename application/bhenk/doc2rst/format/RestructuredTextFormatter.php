<?php

namespace bhenk\doc2rst\format;

use Exception;
use function is_null;
use function str_replace;
use function str_starts_with;

class RestructuredTextFormatter extends AbstractFormatter {

    private ?string $command = null;

    public function handleLine(string $line): bool {
        // ```rst replace $ @
        $lc = $this->increaseLineCount();
        //Log::notice($lc . " " . $line);
        if ($lc == 0) {
            $parts = explode(" ", $line, 2);
            $my_name = $parts[0] ?? null;
            if ("```rst" != $my_name)
                throw new Exception("Wrong formatter. My name is " . self::class . " got " . $line);
            $this->command = $parts[1] ?? null;
            //Log::info($this->command);
            return true;
        }

        if (str_starts_with($line, "```")) {
            //$this->getOrganizer()->addLine(PHP_EOL);
            return false;
        }

        if (!is_null($this->command)) {
            if (str_starts_with($this->command, "replace")) {
                $things = explode(" ", $this->command);
                if (count($things) < 3) throw new Exception("Insufficient parameters: " . $this->command);
                $line = str_replace($things[1], $things[2], $line);
            }
        }
        $this->getOrganizer()->addLine($line);
        return true;
    }
}