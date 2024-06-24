<?php

namespace App\Services;

use Spatie\Browsershot\Browsershot;

class PDF
{
    protected const BASE_PDF_PATH = __DIR__ . "/../../tmp/pdfs";

    public static function make(string $html, string $path)
    {
        Browsershot::html($html)->save(self::BASE_PDF_PATH . "/$path");
    }
}
