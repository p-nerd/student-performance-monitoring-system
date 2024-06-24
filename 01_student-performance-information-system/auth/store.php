<?php

require __DIR__ . "/../boot.php";

use App\Enums\Role;
use App\Services\User;
use Core\Error;
use Core\Old;
use Core\Validate;

$errors = [];

$name = Validate::string($_POST["name"]);
$email = Validate::email($_POST["email"]);
$password = Validate::password($_POST["password"]);
$confirm_password = Validate::password($_POST["confirm_password"]);

if (!$name) {
    $errors["name"] = "The name is required";
}
if (!$email) {
    $errors["email"] = "The email have to be valid";
}
if (!$password) {
    $errors["password"] = "The password have to be valid";
}
if ($password !== $confirm_password) {
    $errors["confirm_password"] = "The passwords is not matching";
}

$user = User::findByEmail($db, $email);
if ($user) {
    $errors["email"] = "The email already exists";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/auth/register.php");
}

User::insert($db, [
    "name" => $name,
    "email" => $email,
    "password" => $password,
    "role" => Role::STUDENT->value,
]);

redirect("/profile");
