<?php

namespace App\Services;

class Template
{
    protected const TEMPLATE_BASE_PATH = __DIR__ . "/../../templates";

    public static function render(string $name, array $data = []): string
    {
        extract($data);
        ob_start();
        include self::TEMPLATE_BASE_PATH . "/$name";
        return ob_get_clean();
    }
}
