<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\globals\LinkUtil;
use bhenk\doc2rst\globals\ProcessState;
use bhenk\doc2rst\process\CommentLexer;
use ReflectionClass;
use Stringable;
use function count;
use function str_ends_with;

class ClassHeadReader implements Stringable {

    private ReflectionClass $rc;

    function __construct() {
        $this->rc = ProcessState::getCurrentClass();
    }

    public function getClassLink($name): string {
//        if (str_starts_with($name, "bhenk")) {
//            return ":ref:`$name`";
//        } elseif ((new ReflectionClass($name))->isInternal()) {
//            $link_name = strtolower($name) . ".php";
//            $display_name = str_replace("\\", "\\\\", $name);
//            $php_net = "https://www.php.net/manual/en/class.$link_name";
//            return "`$display_name <$php_net>`_";
//        } else {
//            return "``$name``";
//            //return str_replace("\\", "\\\\", $name);
//        }
        return LinkUtil::renderLink($name);
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

    public function render(): string {
        return $this->renderHead();
    }


    public function renderHead(): string {
        $s = "| ``" . $this->rc->getNamespaceName() . "``";

        if ($this->rc->isAbstract()) $s .= " | ``Abstract`` ";
        if ($this->rc->isFinal()) $s .= " | ``Final`` ";
        if ($this->rc->isAnonymous()) $s .= " | ``Anonymous`` ";
        // if ($this->rc->isReadOnly()) $s .= " | ``ReadOnly`` ";  // PHP 8.2 
        // if ($this->rc->isCloneable()) $s .= " | ``Cloneable``"; // (nearly) every class is cloneable
        if ($this->rc->isIterable()) $s .= " | ``Iterable`` ";
        if ($this->rc->isInterface()) $s .= " | ``Interface`` ";
        if ($this->rc->isEnum()) $s .= " | ``Enum`` ";
        if ($this->rc->isTrait()) $s .= " | ``Trait`` ";
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;

        // implements
        $s .= $this->listClassLinks("implements", $this->rc->getInterfaceNames());
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL;

        // extends
        $parent_class = $this->rc->getParentClass();
        if ($parent_class) {
            $s .= "| **extends:** " . $this->getClassLink($parent_class->name);
        }
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL;

        // uses
        $s .= $this->listClassLinks("uses", $this->rc->getTraitNames());
        if (!str_ends_with($s, PHP_EOL . PHP_EOL)) $s .= PHP_EOL . PHP_EOL;

        $lexer = new CommentLexer($this->rc);
        $s .= $lexer->getCommentOrganizer()->render();
        return $s;
    }

    public function __toString() {
        return $this->render();
    }
}