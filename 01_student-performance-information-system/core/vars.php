<?php

use App\Enums\Role;
use Core\Auth;
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

$error = fn (string $key) =>  Error::field($key);
$old = fn (string $key) =>  Old::field($key);

$auth = Auth::user($db);
$isTeacher = !$auth ? false : $auth["role"] === Role::TEACHER->value || $auth["role"] === Role::ADMIN->value;
