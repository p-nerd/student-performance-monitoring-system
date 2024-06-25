<?php

namespace Core;

class View
{
    protected const VIEW_BASE_PATH = __DIR__ . "/../views";

    public static function render(string $name, array $data = []): string
    {
        extract($data);
        ob_start();
        include self::VIEW_BASE_PATH . "/$name";
        return ob_get_clean();
    }
}
