<?php

namespace bhenk\doc2rst\globals;

enum Process {

    case current_class;
    case current_method;

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
