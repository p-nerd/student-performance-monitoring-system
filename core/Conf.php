<?php

namespace Core;

class Conf
{
    protected const BASE_DIR = __DIR__ . "/../conf/";

    public static function get(string $name): ?string
    {
        $parts = explode(".", $name);

        if (count($parts) < 2) {
            return null;
        }

        $confFileName = $parts[0];
        $data = require static::BASE_DIR . "/$confFileName.php";

        // Traverse the array based on the parts
        for ($i = 1; $i < count($parts); $i++) {
            if (!isset($data[$parts[$i]])) {
                return null;
            }
            $data = $data[$parts[$i]];
        }

        return $data;
    }
}
