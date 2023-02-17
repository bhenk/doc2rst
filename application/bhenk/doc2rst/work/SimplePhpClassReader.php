<?php

namespace bhenk\doc2rst\work;

use ReflectionClass;
use function array_slice;
use function count;
use function str_contains;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strpos;
use function strrpos;
use function strtolower;
use function substr;
use function trim;

class SimplePhpClassReader implements PhpClassReaderInterface {

    public function getClassLink($name): string {
        if (str_starts_with($name, "bhenk")) {
            return ":ref:`$name`";
        } elseif ((new ReflectionClass($name))->isInternal()) {
            $link_name = strtolower($name) . ".php";
            $display_name = str_replace("\\", "\\\\", $name);
            $php_net = "https://www.php.net/manual/en/class.$link_name";
            return "`$display_name <$php_net>`_";
        } else {
            return str_replace("\\", "\\\\", $name);
        }
    }

    public function listClassLinks(string $caption, array $names): string {
        $s = "";
        if (!empty($names)) {
            $s .= "**$caption:** " . PHP_EOL;
            for ($i = 0; $i < count($names); $i++) {
                $s .= $this->getClassLink($names[$i]);
                if ($i < count($names) - 1) $s .= " | ";
            }
        }
        return $s;
    }

    public function makeDocument(string $namespace, string $classname): string {
        $fq_classname = $namespace . "\\" . $classname;
        $rc = new ReflectionClass($fq_classname);
        $s = ".. _$fq_classname:" . PHP_EOL .PHP_EOL
            . $classname . PHP_EOL
            . str_repeat("=", strlen($classname)) . PHP_EOL
            . PHP_EOL
            . "**namespace:** ``" . $namespace . "``" . PHP_EOL . PHP_EOL;
        if ($rc->isAbstract()) $s .= "``Abstract`` ";
        if ($rc->isFinal()) $s .= "``Final`` ";
        if ($rc->isAnonymous()) $s .= "``Anonymous`` ";
        if ($rc->isReadOnly()) $s .= "``ReadOnly`` ";
        // if ($rc->isCloneable()) $s .= "``Cloneable``"; // (nearly) every class is cloneable
        if ($rc->isIterable()) $s .= "``Iterable`` ";
        if ($rc->isInterface()) $s .= "``Interface`` ";
        if ($rc->isEnum()) $s .= "``Enum`` ";
        if ($rc->isTrait()) $s .= "``Trait`` ";
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;

        // implements
        $s .= $this->listClassLinks("implements", $rc->getInterfaceNames());
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;

        // extends
        $parent_class = $rc->getParentClass();
        if ($parent_class) {
            $s .= "**extends:** " . $this->getClassLink($parent_class->name);
        }
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;

        // uses
        $s .= $this->listClassLinks("uses", $rc->getTraitNames());
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;

        $rows = explode(PHP_EOL, $rc->getDocComment());
        if (isset($rows[0]) and str_contains($rows[0], "/**")) {
            $lines = [];
            foreach (array_slice($rows, 1) as $row) {
                $line = (substr($row, strpos($row, "*") + 1));
                if (str_starts_with($line, " ")) $line = substr($line, 1);
                $lines[] = $line;
            }
            if (isset($lines[0])) {
                $first_line = trim(substr($lines[0], 0, strrpos($lines[0], ".")));
                $s .= "**$first_line**";
            }
            if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;
            foreach (array_slice($lines, 1, count($lines) -2) as $line) {
                $s .= $line . PHP_EOL;
            }
        }

        foreach ($rc->getConstants() as $key => $val) {
            if (!$rc->isEnum())
                $s .= "$key = " .PHP_EOL;
        }

        // content
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;
        $s .= "bla bla";
        return $s;
    }
}