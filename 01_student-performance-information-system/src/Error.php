<?php

namespace App;

class Error
{
    private const KEY = "errors";

    public static function set(string $message, array $fields = [])
    {
        $_SESSION[self::KEY] = [
            "message" => $message,
            "fields" => $fields,
        ];
    }

    public static function get()
    {
        return $_SESSION[self::KEY];
    }
}
