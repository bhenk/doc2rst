<?php

namespace bhenk\doc2rst\globals;

enum PS {

    case scanned_php_files;
    case scanned_js_files;
    case scanned_sql_files;
    case scanned_package_files;

    /**
     * Gets the {@link UnitEnum} for the given name or *null* if it doesn't exist.
     *
     * @param string $name
     * @return PS|null
     */
    public static function forName(string $name): ?PS {
        foreach (PS::cases() as $case) {
            if ($case->name == $name) {
                return $case;
            }
        }
        return null;
    }

}
