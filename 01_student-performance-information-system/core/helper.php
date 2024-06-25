<?php

use Core\View;
use App\Enums\Role;
use Core\Auth;
use Core\DB;
use Core\Error;
use Core\Old;

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
    return new DB(
        [
            "host" => "localhost",
            "port" => 3306,
            "dbname" => "systech_student-performance-information-system",
            "charset" => "utf8mb4"
        ],
        "root",
        "2611"
    );
}

function auth()
{
    return Auth::user(db());;
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

function layout(string $name)
{
    return view("layouts/$name");
}
