<?php

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\model\ClassHeadReaderInterface;
use ReflectionClass;
use function count;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use function strtolower;

class ClassHeadReader implements ClassHeadReaderInterface {

    public function getClassLink($name): string {
        if (str_starts_with($name, "bhenk")) {
            return ":ref:`$name`";
        } elseif ((new ReflectionClass($name))->isInternal()) {
            $link_name = strtolower($name) . ".php";
            $display_name = str_replace("\\", "\\\\", $name);
            $php_net = "https://www.php.net/manual/en/class.$link_name";
            return "`$display_name <$php_net>`_";
        } else {
            return "``$name``";
            //return str_replace("\\", "\\\\", $name);
        }
    }

    public function listClassLinks(string $caption, array $names): string {
        $s = "";
        if (!empty($names)) {
            $s .= "| **$caption:** ";
            for ($i = 0; $i < count($names); $i++) {
                $s .= $this->getClassLink($names[$i]);
                if ($i < count($names) - 1) $s .= " | ";
            }
        }
        return $s;
    }

    public function makeClassHead(ReflectionClass $rc): string {
        $fq_classname = $rc->getName();
        $classname = $rc->getShortName();
        $s = ".. _$fq_classname:" . PHP_EOL . PHP_EOL
            . $classname . PHP_EOL
            . str_repeat("=", strlen($classname)) . PHP_EOL
            . PHP_EOL;

        $s .= "| ``" . $rc->getNamespaceName() . "``";

        if ($rc->isAbstract()) $s .= " | ``Abstract`` ";
        if ($rc->isFinal()) $s .= " | ``Final`` ";
        if ($rc->isAnonymous()) $s .= " | ``Anonymous`` ";
        if ($rc->isReadOnly()) $s .= " | ``ReadOnly`` ";
        // if ($rc->isCloneable()) $s .= " | ``Cloneable``"; // (nearly) every class is cloneable
        if ($rc->isIterable()) $s .= " | ``Iterable`` ";
        if ($rc->isInterface()) $s .= " | ``Interface`` ";
        if ($rc->isEnum()) $s .= " | ``Enum`` ";
        if ($rc->isTrait()) $s .= " | ``Trait`` ";
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;

        // implements
        $s .= $this->listClassLinks("implements", $rc->getInterfaceNames());
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL;

        // extends
        $parent_class = $rc->getParentClass();
        if ($parent_class) {
            $s .= "| **extends:** " . $this->getClassLink($parent_class->name);
        }
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL;

        // uses
        $s .= $this->listClassLinks("uses", $rc->getTraitNames());
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;
        return $s;
    }
}