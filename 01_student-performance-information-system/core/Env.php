<?php

namespace Core;

use Exception;
use Throwable;

class Env
{
    public static function load()
    {
        static::loadEnv(__DIR__ . "/../.env");
    }

    public static function get(string $key): ?string
    {
        // return getenv("hello");
        return null;
    }

    protected static function loadEnv($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("Environment file not found: " . $filePath);
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Split the line into a key and a value
            list($name, $value) = explode('=', $line, 2);

            // Remove any surrounding quotes from the value
            $value = trim($value);
            if (preg_match('/^"(.*)"$/', $value, $matches) || preg_match("/^'(.*)'$/", $value, $matches)) {
                $value = $matches[1];
            }

            // Set the environment variable
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}
