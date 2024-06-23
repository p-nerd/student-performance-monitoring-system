<?php

require_once "../boot.php";

use Core\Error;
use Core\Old;
use Core\Validate;

$id = $_REQUEST["id"];

$errors = [];

$first_name = Validate::string($_POST["first_name"]);
$last_name = Validate::string($_POST["last_name"]);
$email = Validate::email($_POST["email"]);
$phone_number = Validate::phoneNumber($_POST["phone_number"]);

if (!$first_name) {
    $errors["first_name"] = "The first name is required";
}
if (!$last_name) {
    $errors["last_name"] = "The last name is required";
}
if (!$email) {
    $errors["email"] = "The email have to be valid";
}
if (!$phone_number) {
    $errors["phone_number"] = "The email have to be valid";
}

$student = $db->query("SELECT * FROM students WHERE email=:email", ["email" => $email])->find();
if ($student && $student["id"] !== (int)$id) {
    $errors["email"] = "The email already exists";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/students/edit.php?id=$id");
}

$db->query('UPDATE students SET first_name=:first_name, last_name=:last_name, email=:email, phone_number=:phone_number WHERE id=:id', [
    "id" => $id,
    "first_name" => $first_name,
    "last_name" => $last_name,
    "email" => $email,
    "phone_number" => $phone_number,
]);

redirect("/students/index.php");
