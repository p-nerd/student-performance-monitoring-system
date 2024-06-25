
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

$path = PDF::make($html, "student-$id-{$student['name']}");

if (!file_exists($path)) {
    echo "pdf file is not found";
    exit;
}

header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($path) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path));

// Clear output buffer
ob_clean();
flush();

// Read the file and output its contents
readfile($path);
exit;
