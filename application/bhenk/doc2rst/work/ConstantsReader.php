<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\globals\ProcessState;
use ReflectionClass;
use ReflectionClassConstant;
use Stringable;
use function gettype;
use function str_repeat;
use function str_replace;
use function strlen;

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

    public function makeCodeBlock(array $constants, string $s): string {
        if (!$this->rc->isEnum()) {
            $k1 = 0;
            $k2 = 0;
            $k3 = 0;
            foreach ($constants as $key => $val) {
                if (strlen($key) > $k1) $k1 = strlen($key);
                $typ = gettype($val);
                if (strlen($typ) > $k2) $k2 = strlen($typ);
                if (strlen($val) > $k3) $k3 = strlen($val);
            }
            $s .= "::" . PHP_EOL . PHP_EOL;
            foreach ($constants as $key => $val) {
                if ($key != "NL") {
                    $typ = gettype($val);
                    //$val = str_replace($val, "\n", "new line");
                    $s .= "    " . $key . str_repeat(" ", $k1 - strlen($key)) . " "
                        . "(" . $typ . ")" . str_repeat(" ", $k2 - (strlen($typ))) . " "
                        . $val . str_repeat(" ", $k3 - strlen($val)) . PHP_EOL;
                }
            }

        }
        return $s;
    }

    /**
     * @param array $constants
     * @return string
     */
    public function makeTable(array $constants): string {
        $s = "";
        if (!$this->rc->isEnum()) {
            $k1 = 0;
            $k2 = 0;
            $k3 = 0;
            foreach ($constants as $key => $val) {
                if (strlen($key) > $k1) $k1 = strlen($key);
                $typ = gettype($val);
                if (strlen($typ) > $k2) $k2 = strlen($typ);
                if (strlen($val) > $k3) $k3 = strlen($val);
            }
            $k2 += 2;
            $s .= str_repeat("=", $k1) . " "
                . str_repeat("=", $k2) . " "
                . str_repeat("=", $k3) . PHP_EOL;
            foreach ($constants as $key => $val) {
                if ($key != "NL") {
                    $typ = gettype($val);
                    $val = str_replace("\033", "\\033", $val);
                    $val = str_replace("\n", "\\n", $val);
                    if ($val == "") $val = '""';
                    $s .= $key . str_repeat(" ", $k1 - strlen($key)) . " "
                        . "(" . $typ . ")" . str_repeat(" ", $k2 - (strlen($typ) + 2)) . " "
                        . "```" . $val . "```" . str_repeat(" ", $k3 - strlen($val)) . PHP_EOL;
                }
            }
            $s .= str_repeat("=", $k1) . " "
                . str_repeat("=", $k2) . " "
                . str_repeat("=", $k3) . PHP_EOL;
        }
        return $s;
    }
}