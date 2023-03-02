<?php

namespace bhenk\doc2rst\globals;

use function in_array;

class Linker {

    private static array $data_types = [
        "string",
        "int",
        "float",
        "double",
        "bool",
        "array",
        "object",
        "null",
        "resource",
        "void",
        "static",
        "mixed",
    ];

    public static function findType(string $type): string {
        if (in_array($type, self::$data_types)) return $type;

        return $type;
    }

//    public static function findFQCN(string $type): string {
//        if (str_contains($type, "\\")) return $type;
//        if (is_null(ProcessState::getCurrentClass())) return $type;
//        $file = ProcessState::getCurrentClass()->getFileName();
//        $string = file_get_contents($file);
//        $lines = explode(PHP_EOL, $string);
//        foreach ($lines as $line) {
//            if (str_contains($line, "use") and str_contains($line, $type)) {
//                $start = strpos($line, " ") + 1;
//                $semicolon = strpos($line, ";");
//                return substr($line, $start, ($semicolon - $start));
//            }
//        }
//        return $type;
//    }

}