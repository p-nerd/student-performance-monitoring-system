<?php

namespace Core;

class Validate
{
    public static function string(string $value, int $min = 1, int $max = 255): string|bool
    {
        $value = trim($value);
        $len   = strlen($value);

        if ($min <= $len && $len <= $max) {
            return $value;
        }
        return false;
    }
    public static function email(string $email): string|bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function phoneNumber(string $phoneNumber): string|bool
    {
        return self::string($phoneNumber);
    }

    public static function int(string $email): int|bool
    {
        return filter_var($email, FILTER_VALIDATE_INT);
    }
}
