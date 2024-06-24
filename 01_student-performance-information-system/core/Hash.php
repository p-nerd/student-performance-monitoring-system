<?php

namespace Core;

class Hash
{
    /**
     * Hash a string using the bcrypt algorithm.
     */
    public static function make(string $plainText): ?string
    {
        $hash = password_hash($plainText, PASSWORD_BCRYPT);
        if ($hash === false) {
            throw new \RuntimeException('Password hash failed.');
        }
        return $hash;
    }

    /**
     * Verify if a plain text string matches a hashed string.
     */
    public static function check(string $plainText, string $hashedText): bool
    {
        return password_verify($plainText, $hashedText);
    }
}
