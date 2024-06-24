<?php

require __DIR__ . "/../boot.php";

use App\Services\Student;
use Core\Error;
use Core\Old;
use Core\Validate;

$id = $_REQUEST["id"];

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

$student = Student::find($db, $id);
if ($student && $student["student_id"] !== (int)$id) {
    $errors["email"] = "The email already exists";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/students/edit.php?id=$id");
}

$db->query('UPDATE users SET name=:name, email=:email WHERE id=:id', [
    "id" => $student["user_id"],
    "name" => $name,
    "email" => $email,
]);

$db->query('UPDATE students SET phone_number=:phone_number WHERE id=:id', [
    "id" => $student["student_id"],
    "phone_number" => $phone_number,
]);

redirect("/students");
