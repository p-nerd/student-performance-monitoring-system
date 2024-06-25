<?php

namespace Core;

class View
{
    public const VIEW_BASE_PATH = __DIR__ . "/../views";

    public static function render(string $name, array $data = []): string
    {
        require __DIR__ . "/vars.php";
        extract($data);
        ob_start();
        include self::VIEW_BASE_PATH . "/$name.php";
        return ob_get_clean();
    }
}
