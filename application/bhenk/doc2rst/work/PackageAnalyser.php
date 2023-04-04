<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\work;

use bhenk\doc2rst\globals\RunConfiguration;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\rst\Table;
use Stringable;
use function array_unique;
use function basename;
use function count;
use function implode;
use function ksort;
use function str_starts_with;
use function strlen;
use function strrpos;
use function substr;

/**
 * Analyse interdependencies of packages
 */
class PackageAnalyser {

    private array $uses = [];

    public function addParser(PhpParser $parser, string $fqn): void {
        $ns_self = $parser->getNamespace() ? $parser->getNamespace()->getValue() : "no namespace";
        $ns = explode("\\", $ns_self);
        if (count($ns) > 1) {
            $vendor_package = $ns[0] . "\\" . $ns[1];
        } else {
            $vendor_package = basename(RunConfiguration::getVendorDirectory());
        }
        foreach ($parser->getUses() as $use) {
            if (str_starts_with($use->getValue(), $vendor_package)) {
                $o = $use->getValue();
                $namespace = substr($o, 0, strrpos($o, "\\") - strlen($o));
                $this->uses[$namespace][] = $fqn;
                Log::debug($fqn . " uses " . $namespace);
            }
        }
    }

    public function toRst(): Stringable|string {
        if (empty($this->uses)) return "";
        $table = new Table(2);
        $table->setHeading("Depends on", "Dependency invoked by");
        ksort($this->uses);
        foreach ($this->uses as $key => $val) {
            $classes = TypeLinker::resolveMultipleFQCN(array_unique($val));
            $table->addRow(":ref:`" . $key . "`", implode(" | ", $classes));
        }
        return $table;
    }

    /**
     * @return array
     * @noinspection PhpUnused
     */
    public function getUses(): array {
        return $this->uses;
    }

}