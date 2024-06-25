<?php

require __DIR__ . "/../boot.php";

use App\Enums\Role;
use App\Services\Student;
use App\Services\User;
use Core\Error;
use Core\Old;
use Core\Validate;

$errors = [];

$name = Validate::string($_POST["name"]);
$email = Validate::email($_POST["email"]);
$phone_number = Validate::phoneNumber($_POST["phone_number"]);

if (!$name) {
    $errors["name"] = "The name is required";
}
if (!$email) {
    $errors["email"] = "The email have to be valid";
}
if (!$phone_number) {
    $errors["phone_number"] = "The email have to be valid";
}

$user = User::findByEmail($db, $email);
if ($user) {
    $errors["email"] = "The email already exists";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/students/create.php");
}

$user_id = User::insert($db, [
    "name" => $name,
    "email" => $email,
    "password" => "password123",
    "role" => Role::STUDENT->value,
]);

Student::insert($db, [
    "phone_number" => $phone_number,
    "user_id" => $user_id,
]);

redirect("/students");
