<?php

namespace App\Controllers;

use App\Services\Course;
use App\Services\PDF;
use App\Services\Student;
use App\Enums\Role;
use App\Services\User;
use Core\Error;
use Core\Old;
use Core\Validate;

class StudentController
{
    public function index()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        $students = Student::all(db());

        return view("pages/students/index", [
            "students" => $students
        ]);
    }

    public function result()
    {

        $id = $_REQUEST["id"];

        $student = Student::find(db(), $id);

        if (!isTeacher() && auth()["id"] !== $student["user_id"]) {
            abort("Your don't have permission to access this", 403);
        }

        $courses = Student::addPointToCourses(Student::courses(db(), $id));
        $semesters = Student::semesters($courses);
        $gpas = Student::gpas($semesters);
        $cgpa = Course::cgpa($courses);

        return view("pages/students/result", [
            "id" => $id,
            "student" => $student,
            "courses" => $courses,
            "semesters" => $semesters,
            "gpas" => $gpas,
            "cgpa" => $cgpa,
        ]);
    }

    public function download()
    {
        $id = $_REQUEST["id"];

        $student = Student::find(db(), $id);

        if (!isTeacher() && auth()["id"] !== $student["user_id"]) {
            abort("Your don't have permission to access this", 403);
        }

        $courses = Student::addPointToCourses(Student::courses(db(), $id));
        $semesters = Student::semesters($courses);
        $gpas = Student::gpas($semesters);

        $cgpa = Course::cgpa($courses);

        $html = view("pdfs/result", [
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
    }

    public function create()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        return view("pages/students/create");
    }

    public function store()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        $errors = [];

        $name = Validate::string($_POST["name"]);
        $email = Validate::email($_POST["email"]);
        $phone_number = Validate::phoneNumber($_POST["phone_number"]);
        $major = Validate::string($_POST["major"]);

        if (!$name) $errors["name"] = "The name is required";
        if (!$email) $errors["email"] = "The email have to be valid";
        if (!$phone_number) $errors["phone_number"] = "The phone number have to be valid";
        if (!$major) $errors["major"] = "The major is required";


        $user = User::findByEmail(db(), $email);
        if ($user) {
            $errors["email"] = "The email already exists";
        }


        if (!empty($errors)) {
            Old::set($_POST);
            Error::set("validation error", $errors);
            redirect("/students/create");
        }

        $user_id = User::insert(db(), [
            "name" => $name,
            "email" => $email,
            "password" => "password123",
            "role" => Role::STUDENT->value,
            "phone_number" => $phone_number
        ]);

        Student::insert(db(), [
            "major" => $major,
            "user_id" => $user_id,
        ]);

        redirect("/students");
    }

    public function edit()
    {
        $id = $_REQUEST["id"];

        $student = Student::find(db(), $id);

        if (!isTeacher() && auth()["id"] !== $student["user_id"]) {
            abort("Your don't have permission to access this", 403);
        }

        return view("pages/students/edit", [
            "id" => $id,
            "student" => $student
        ]);
    }

    public function update()
    {
        $id = $_REQUEST["id"];

        $student = Student::find(db(), $id);

        if (!isTeacher() && auth()["id"] !== $student["user_id"]) {
            abort("Your don't have permission to access this", 403);
        }

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

        $student = Student::find(db(), $id);
        if ($student && $student["student_id"] !== (int)$id) {
            $errors["email"] = "The email already exists";
        }

        if (!empty($errors)) {
            Old::set($_POST);
            Error::set("validation error", $errors);
            redirect("/students/edit?id=$id");
        }

        db()->query('UPDATE users SET name=:name, email=:email WHERE id=:id', [
            "id" => $student["user_id"],
            "name" => $name,
            "email" => $email,
        ]);

        db()->query('UPDATE students SET phone_number=:phone_number WHERE id=:id', [
            "id" => $student["student_id"],
            "phone_number" => $phone_number,
        ]);

        redirect("/students");
    }

    public function destory()
    {
        $id = $_REQUEST["id"];

        $student = Student::find(db(), $id);

        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        db()->query("DELETE FROM student_courses WHERE student_id=:student_id", ["student_id" => $id]);
        db()->query("DELETE FROM students WHERE id=:id", ["id" => $id]);
        db()->query("DELETE FROM users WHERE id=:id", ["id" => $student["user_id"]]);

        redirect("/students");
    }

    public function assignCoursesEdit()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        $id = Validate::int($_REQUEST["id"]);

        $courses = Course::all(db());
        $student = Student::find(db(), $id);
        $assignedCourses = Course::findsByStudent(db(), $student["student_id"]);

        $leftCourses = parray($courses)
            ->filter(function ($course) use ($assignedCourses) {
                return !parray($assignedCourses)->find(fn ($c) => $c["course_id"] === $course["id"]);
            })
            ->get();

        return view("pages/students/assign-courses", [
            "student" => $student,
            "assignedCourses" => $assignedCourses,
            "leftCourses" => $leftCourses,
        ]);
    }

    public function assignCoursesUpdate()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        $student_id = Validate::int($_POST["student_id"]);
        $course_id = Validate::int($_POST["course_id"]);

        db()->query("INSERT INTO student_courses(student_id, course_id) VALUES(:student_id, :course_id)", [
            "student_id" => $student_id,
            "course_id" => $course_id
        ]);

        redirect("/students/assign-courses?id=$student_id");
    }

    public function assignCoursesDestroy()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        $student_id = Validate::int($_POST["student_id"]);
        $course_id = Validate::int($_POST["course_id"]);

        db()->query("DELETE FROM student_courses WHERE student_id=:student_id AND course_id=:course_id", [
            "student_id" => $student_id,
            "course_id" => $course_id
        ]);

        redirect("/students/assign-courses?id=$student_id");
    }

    public function giveMark()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        $student_id = Validate::int($_POST["student_id"]);
        $course_id = Validate::int($_POST["course_id"]);
        $mark = Validate::int($_POST["mark"]);

        db()->query('UPDATE student_courses SET mark=:mark WHERE student_id=:student_id AND course_id=:course_id', [
            "student_id" => $student_id,
            "course_id" => $course_id,
            "mark" => $mark
        ]);

        redirect("/students/result?id=$student_id");
    }
}
