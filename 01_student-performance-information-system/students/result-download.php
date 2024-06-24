<?php

require __DIR__ . "/../boot.php";

use App\Services\Course;
use App\Services\Student;
use App\Services\PDF;
use App\Services\Template;

$id = $_REQUEST["id"];

$student = Student::find($db, $id);
$courses = Student::addPointToCourses(Student::courses($db, $id));
$semesters = Student::semesters($courses);
$gpas = Student::gpas($semesters);

$cgpa = Course::cgpa($courses);

$html = Template::render("result.php", [
    "student" => $student,
    "courses" => $courses,
    "semesters" => $semesters,
    "gpas" => $gpas,
    "cgpa" => $cgpa,
]);


PDF::make($html, "result.pdf");
