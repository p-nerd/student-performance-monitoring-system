<?php

require __DIR__ . "/../vendor/autoload.php";

use Core\DB;
use Core\Error;
use Core\Old;

$db = new DB(
    [
        "host" => "localhost",
        "port" => 3306,
        "dbname" => "systech_student-performance-information-system",
        "charset" => "utf8mb4"
    ],
    "root",
    "2611"
);

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

$error = fn (string $key) =>  Error::field($key);
$old = fn (string $key) =>  Old::field($key);
