<?php

namespace bhenk\doc2rst\globals;

enum Sources {

    case directories;
    case php_files;
    case js_files;
    case sql_files;
    case md_files;
    case rst_files;
    case other_files;

    /**
     * Gets the {@link UnitEnum} for the given name or *null* if it doesn't exist.
     *
     * @param string $name
     * @return Sources|null
     */
    public static function forName(string $name): ?Sources {
        foreach (Sources::cases() as $case) {
            if ($case->name == $name) {
                return $case;
            }
        }
        return null;
    }

}
