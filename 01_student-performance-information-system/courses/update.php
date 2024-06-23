<?php

require_once "../boot.php";

use Core\Error;
use Core\Old;
use Core\Validate;

$id = $_REQUEST["id"];

$errors = [];

$name = Validate::string($_POST["name"]);
$credit = Validate::int($_POST["credit"]);
$semester = Validate::int($_POST["semester"]);
$mark = Validate::int($_POST["mark"]);

if (!$name) {
    $errors["name"] = "The name is required";
}
if (!$credit) {
    $errors["credit"] = "The credit is required";
}
if (!$semester) {
    $errors["semester"] = "The semester is required";
}
if (!$mark) {
    $errors["mark"] = "The mark is required";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/courses/edit.php?id=$id");
}

$db->query('UPDATE courses SET name=:name, credit=:credit, semester=:semester, mark=:mark WHERE id=:id', [
    "id" => $id,
    "name" => $name,
    "credit" => $credit,
    "semester" => $semester,
    "mark" => $mark,
]);

redirect("/courses/index.php");
