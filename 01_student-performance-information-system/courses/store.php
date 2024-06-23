<?php

require_once "../boot.php";

use Core\Error;
use Core\Old;
use Core\Validate;

$errors = [];

$name = Validate::string($_POST["name"]);
$credit = Validate::int($_POST["credit"]);
$mark = Validate::int($_POST["mark"]);

if (!$name) {
    $errors["name"] = "The name is required";
}
if (!$credit) {
    $errors["credit"] = "The credit is required";
}
if (!$mark) {
    $errors["mark"] = "The mark is required";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/courses/create.php");
}

$db->query('INSERT INTO courses(name, credit, mark) VALUES(:name, :credit, :mark)', [
    "name" => $name,
    "credit" => $credit,
    "mark" => $mark,
]);

redirect("/courses/index.php");
