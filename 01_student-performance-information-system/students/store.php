<?php

require __DIR__ . "/../boot.php";

use App\Enums\Role;
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

$user = $db->query("SELECT * FROM users WHERE email=:email", ["email" => $email])->find();
if ($user) {
    $errors["email"] = "The email already exists";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/students/create.php");
}

$user_id = $db->query('INSERT INTO users(name, email, password, role) VALUES(:name, :email, :password, :role)', [
    "name" => $name,
    "email" => $email,
    "password" => "password123",
    "role" => Role::STUDENT->value,
])->lastInsertId();

$db->query('INSERT INTO students(phone_number, user_id) VALUES(:phone_number, :user_id)', [
    "phone_number" => $phone_number,
    "user_id" => $user_id,
]);

redirect("/students");
