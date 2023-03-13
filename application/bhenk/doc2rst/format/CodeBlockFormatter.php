<?php

namespace bhenk\doc2rst\format;

use function str_starts_with;

/**
 * Renders a code block
 *
 * This nameless formatter is handling everything between 3 tics that start on a new line and that are not followed
 * by a formatter name. The block is ended with 3 tics on a new line.
 * ```rst
 * .. admonition:: syntax
 *
 *    .. code-block::
 *
 *       ```
 *       <code>
 *          <more code>
 *       (...)
 *       ```
 * ```
 * This is the result:
 * ```
 * <code>
 *    <more code>
 * (...)
 * ```
 *
 *
 */
class CodeBlockFormatter extends AbstractFormatter {

    /**
     * @inheritdoc
     * @param string $line line of a code block
     * @return bool *true* as long as second and following lines do not start with 3 tics
     */
    public function handleLine(string $line): bool {
        // ```
        $lc = $this->increaseLineCount();
        if ($lc == 0) {
            $line = PHP_EOL . "..  code-block::" . PHP_EOL;
            $this->addLine($line);
            return true;
        }
        if (str_starts_with($line, "```")) {
            $this->addLine(PHP_EOL);
            return false;
        }
        $line = "   " . $line;
        $this->addLine($line);
        return true;
    }
}