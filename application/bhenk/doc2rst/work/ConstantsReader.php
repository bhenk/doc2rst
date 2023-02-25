<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\globals\ProcessState;
use ReflectionClass;
use ReflectionClassConstant;
use Stringable;
use function str_replace;

class ConstantsReader implements Stringable {

    private ReflectionClass $rc;

    function __construct() {
        $this->rc = ProcessState::getCurrentClass();
    }

    public function __toString(): string {
        return $this->render();
    }

    public function render(): string {
        $s = "";
        $constants = $this->rc->getConstants(ReflectionClassConstant::IS_PUBLIC
            | ReflectionClassConstant::IS_PROTECTED);
        if (count($constants) == 0) return $s;
        $s .= PHP_EOL . ".. _" . $this->rc->name . "::constants:" . PHP_EOL . PHP_EOL;
        $s .= "constants"
            . PHP_EOL
            . "~~~~~~~~~"
            . PHP_EOL . PHP_EOL;

        $s .= $this->makeDefinitionList($constants);

        return $s . PHP_EOL;
    }

    public function makeDefinitionList(array $constants): string {
        $s = "";
        if (!$this->rc->isEnum()) {
            foreach ($constants as $key => $val) {
                $link = $this->rc->getName() . "::" . $key;
                $val = str_replace("\033", "\\033", $val);
                $val = str_replace("\n", "\\n", $val);
                if ($val == "") $val = '""';
                $s .= PHP_EOL . PHP_EOL
                    . ".. _" . $link . ":"
                    . PHP_EOL . PHP_EOL . PHP_EOL
                    . $this->rc->getShortName() . "::" . $key . PHP_EOL
                    . "    ```$val```" . PHP_EOL;
            }
        }
        return $s;
    }

}