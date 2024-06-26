<?php

use Core\View;
use App\Enums\Role;
use Core\Auth;
use Core\DBInstance;
use Core\Env;
use Core\Error;
use Core\Image;
use Core\Old;
use PNerd\Util\PArray;

function abort(string $message, $code = 500): void
{
    echo $message;
    http_response_code($code);
    die();
}

function old(string $key)
{
    return Old::field($key);;
}

function error(string $key)
{
    return Error::field($key);
}

function db()
{
    return DBInstance::getInstance()->db;
}

function auth()
{
    return Auth::user(db());;
}

function isStudent()
{
    $auth = auth();
    return !$auth ? false : $auth["role"] === Role::STUDENT->value;
}

function isTeacher()
{
    $auth = auth();
    return !$auth ? false : $auth["role"] === Role::TEACHER->value || $auth["role"] === Role::ADMIN->value;
}


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

function component(string $name, array $data = [])
{
    return view("components/$name", $data);
}

function layout(string $name)
{
    return view("layouts/$name");
}

function env(string $key): ?string
{
    return Env::get($key);
}

function parray(array $array)
{
    return new PArray($array);
}

function image(string $name): string
{
    return Image::url($name);
}
