<?php

namespace Core;

use Exception;

class File
{
    public static function createDirIfNotExist(string $path)
    {
        if (is_dir($path)) {
            return;
        }
        if (!mkdir($path, 0755, true)) {
            throw new Exception("Failed to create directory '$path'");
        }
    }

    public static function deleteFileIfExist(string $path)
    {
        if (!file_exists($path)) {
            return;
        }
        if (!unlink($path)) {
            throw new Exception("The file could not be deleted.");
        }
    }
}
