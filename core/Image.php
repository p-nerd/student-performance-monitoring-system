<?php

namespace Core;

use Exception;

class Image
{
    protected const BASE_DIR = __DIR__ . "/../tmp/images/";

    public static function createDir()
    {
        File::createDirIfNotExist(self::BASE_DIR);
    }

    public static function isExist($file)
    {
        return $file["name"];
    }

    public static function save($file)
    {
        $targetFile = self::BASE_DIR . basename($file["name"]);

        // Check if file already exists
        if (file_exists($targetFile)) {
            $targetFile = self::BASE_DIR . time() . basename($file["name"]);
        }

        // Check file size (e.g., limit to 500KB)
        if ($file["size"] > 500000) {
            throw new Exception("Sorry, your file is too large.");
        }

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        // Allow certain file formats (optional, e.g., only images)
        $allowedTypes = array("jpg", "png", "jpeg", "gif");
        if (!in_array($imageFileType, $allowedTypes)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
            throw new Exception("Sorry, there was an error uploading your file.");
        }

        return htmlspecialchars(basename($file["name"]));
    }

    public static function path(string $imageName): string
    {
        return self::BASE_DIR . "/$imageName";
    }

    public static function url(?string $imageName): ?string
    {
        if (!$imageName) {
            return null;
        }
        return "/images/$imageName";
    }

    protected static function generateName(): string
    {
        $random_bytes = random_bytes(16);
        return hash('sha256', $random_bytes);
    }
}
