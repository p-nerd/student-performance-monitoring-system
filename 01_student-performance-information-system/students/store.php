<?php

require_once "../boot.php";

use App\Error;

$errors = [];

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];

$student = $db->query("SELECT * FROM students WHERE email=:email", ["email" => $email])->find();

if ($student) {
    $errors["email"] = "The email already exists";
}

if (!empty($errors)) {
    Error::set("validation error", $errors);
    redirect("/students/create.php");
}


$db->query('INSERT INTO students(first_name, last_name, email, phone_number) VALUES(:first_name, :last_name, :email, :phone_number)', [
    "first_name" => $first_name,
    "last_name" => $last_name,
    "email" => $email,
    "phone_number" => $phone_number,
]);

redirect("/students/index.php");
