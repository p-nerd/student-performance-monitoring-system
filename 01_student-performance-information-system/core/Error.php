<?php

namespace Core;

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
        if (!array_key_exists(self::KEY, $_SESSION ?? [])) {
            return null;
        }
        return $_SESSION[self::KEY];
    }

    public static function field(string $key): ?string
    {
        $errors = self::get();
        if (!$errors || !array_key_exists("fields", $errors)) {
            return null;
        }
        $fields = $errors["fields"];
        if (!$fields || !array_key_exists($key, $fields)) {
            return null;
        }
        return "{$fields[$key]}";
    }
}
