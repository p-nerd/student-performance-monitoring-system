<?php

require __DIR__ . "/../boot.php";

use Core\Error;
use Core\Old;
use Core\Validate;

$errors = [];

$name = Validate::string($_POST["name"]);
$credit = Validate::int($_POST["credit"]);
$semester = Validate::int($_POST["semester"]);

if (!$name) {
    $errors["name"] = "The name is required";
}
if (!$credit) {
    $errors["credit"] = "The credit is required";
}
if (!$semester) {
    $errors["semester"] = "The semester is required";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/courses/create.php");
}

$db->query('INSERT INTO courses(name, credit, mark) VALUES(:name, :credit, :mark)', [
    "name" => $name,
    "credit" => $credit,
    "semester" => $semester,
]);

redirect("/courses");
