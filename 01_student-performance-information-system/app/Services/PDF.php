<?php

namespace App\Services;

use Spatie\Browsershot\Browsershot;

class PDF
{
    protected const BASE_PDF_PATH = __DIR__ . "/../../tmp/pdfs";

    public static function make(string $html, string $name)
    {
        $path = self::BASE_PDF_PATH . "/" . self::sluggify($name) . ".pdf";
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
