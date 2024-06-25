<?php

require_once __DIR__ . "/vars.php";

use Core\View;

function redirect(string $uri): void
{
    header("location: $uri");
    exit();
}

function dd($value): void
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}

function view(string $name, array $data = [])
{
    return View::render($name, $data);
}

function layout(string $name)
{
    require_once View::VIEW_BASE_PATH  . "/layouts/" . $name . ".php";
}
