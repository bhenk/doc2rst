<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\rst\Table;
use bhenk\doc2rst\work\PhpParser;
use bhenk\doc2rst\work\TypeLinker;
use Stringable;
use function array_unique;
use function basename;
use function implode;
use function ksort;
use function str_starts_with;
use function strlen;
use function strrpos;
use function substr;

class TreeHelper {

    private array $uses = [];

    public function addParser(PhpParser $parser, string $fqn): void {
        $vendor = basename(RunConfiguration::getVendorDirectory());
        foreach ($parser->getUses() as $use) {
            if (str_starts_with($use->getValue(), $vendor)) {
                $o = $use->getValue();
                $namespace = substr($o, 0, strrpos($o, "\\") - strlen($o));
                $this->uses[$namespace][] = $fqn;
            }
        }
    }

    public function getEntries(): Stringable|string {
        if (empty($this->uses)) return "";
        $table = new Table(2);
        $table->setHeading("Depends on", "dependency caused by");
        ksort($this->uses);
        foreach ($this->uses as $key => $val) {
            $classes = TypeLinker::resolveMultipleFQCN(array_unique($val));
            $table->addRow(":ref:`" . $key . "`", implode(" | ", $classes));
        }
        return $table;
    }

    /**
     * @return array
     */
    public function getUses(): array {
        return $this->uses;
    }

}