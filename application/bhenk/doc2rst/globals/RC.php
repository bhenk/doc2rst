<?php

namespace bhenk\doc2rst\globals;

use UnitEnum;

/**
 * Holds key names for Container {@link RunConfiguration}.
 */
enum RC {

    case application_root;
    case source_directory;
    case doc_root;
    case api_directory;
    case log_level;

    /**
     * Gets the {@link UnitEnum} for the given name or *null* if it doesn't exist.
     *
     * @param string $name
     * @return RC|null
     */
    public static function forName(string $name): ?RC {
        foreach (RC::cases() as $case) {
            if ($case->name == $name) {
                return $case;
            }
        }
        return null;
    }

}
