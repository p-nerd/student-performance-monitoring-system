<?php

use App\Services\Student;

require __DIR__ . "/../boot.php";

$id = $_REQUEST["id"];

$student = Student::find($db, $id);

$db->query("DELETE FROM students WHERE id=:id", ["id" => $id]);
$db->query("DELETE FROM users WHERE id=:id", ["id" => $student["user_id"]]);

redirect("/students");
