<?php

namespace App\Services;

use Core\File;
use Spatie\Browsershot\Browsershot;

class PDF
{
    protected const BASE_DIR = __DIR__ . "/../../tmp/pdfs";

    public static function createDir()
    {
        File::createDirIfNotExist(self::BASE_DIR);
    }

    public static function make(string $html, string $name)
    {
        $path = self::BASE_DIR . "/" . self::sluggify($name) . ".pdf";
        Browsershot::html($html)->save($path);
        return $path;
    }
    public static function sluggify(string $string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
        $string = preg_replace('/[\s-]+/', ' ', $string);
        $string = preg_replace('/\s/', '-', $string);
        return $string;
    }
}
