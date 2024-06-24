<?php

namespace Core;

class Old
{
    private const KEY = "old";

    public static function set(array $old = [])
    {
        $_SESSION[self::KEY] = $old;
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
        $old = self::get();
        if (!$old || !array_key_exists($key, $old)) {
            return null;
        }
        return $old[$key];
    }

    public static function flash()
    {
        $_SESSION[self::KEY] = null;
    }
}
