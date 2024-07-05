<?php

namespace Core;

class Conf
{
    protected const BASE_DIR = __DIR__ . "/../conf/";

    public static function get(string $name): string
    {
        $parts = explode(".", $name);

        $confFileName = $parts[0];

        $data = require static::BASE_DIR . "/$confFileName.php";

        for ($i = 1; $i < count($parts); $i++) {
            $data = $data[$parts[$i]];
        }

        return $data ?? null;
    }
}
