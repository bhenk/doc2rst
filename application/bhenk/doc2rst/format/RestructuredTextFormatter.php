<?php

namespace bhenk\doc2rst\format;

use RuntimeException;
use function is_null;
use function str_replace;
use function str_starts_with;

/**
 * This RestructuredTextFormatter is handling literal reStructuredText
 *
 * This formatter is started with 3 tics on a new line, followed by *rst*. Optionally this is followed by a command
 * followed by zero or more parameters. The block is ended with 3 tics on a new line.
 * ```rst
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       ```rst [command] [...]
 *       .. rst instructions
 *       (...)
 *       ```
 * ```
 * RestructuredTextFormatter for now only knows one command: :tech:`replace`. This command works similar to the
 * PHP-function *str_replace* and works on the contents of the block. The :tech:`replace` command takes 2
 * parameters: *search-string*, *replace-string*.
 * ```rst
 * .. admonition:: Example
 *
 *    .. code-block::
 *
 *       ```rst replace & @
 *       .. code-block::
 *
 *          &param ["Type"] $[name] [<description>]
 *
 *       ```
 * ```
 * The result:
 * ```rst replace & @
 * .. code-block::
 *
 *    &param ["Type"] $[name] [<description>]
 *
 * ```
 * In the above the tag-name :tech:`@\ param` can be in a code block of the PHPDoc, without being
 * mangled by
 * your IDE, that thinks you misplaced a tag.
 *
 * Of course, you can always use *rst* directly in your PHPDocs:
 * ```
 * .. hint:: text of special interest
 * ```
 * Result:
 *
 * .. hint:: text of special interest
 *
 */
class RestructuredTextFormatter extends AbstractFormatter {

    private ?string $command = null;

    /**
     * @inheritdoc
     * @param string $line line of a code block
     * @return bool *true* as long second and following lines do not start with 3 tics
     */
    public function handleLine(string $line): bool {
        // ```rst replace $ @
        $lc = $this->increaseLineCount();
        if ($lc == 0) $this->addLine(PHP_EOL);

        if ($lc == 0) {
            $parts = explode(" ", $line, 2);
            $this->command = $parts[1] ?? null;
            return true;
        }

        if (str_starts_with($line, "```")) {
            $this->addLine(PHP_EOL);
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
        $this->addLine($line);
        return true;
    }
}