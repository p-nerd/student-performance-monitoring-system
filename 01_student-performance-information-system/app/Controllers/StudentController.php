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
        return view("pages/students/index", [
            "students" => Student::all(db())
        ]);
    }

    public function result()
    {
        $id = $_REQUEST["id"];

        $student = Student::find(db(), $id);
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
        return view("pages/students/create");
    }

    public function store()
    {
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
        ]);

        Student::insert(db(), [
            "phone_number" => $phone_number,
            "user_id" => $user_id,
        ]);

        redirect("/students");
    }

    public function edit()
    {
        $id = $_REQUEST["id"];
        $student = Student::find(db(), $id);

        return view("pages/students/edit", [
            "id" => $id,
            "student" => $student
        ]);
    }

    public function update()
    {
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

        db()->query("DELETE FROM students WHERE id=:id", ["id" => $id]);
        db()->query("DELETE FROM users WHERE id=:id", ["id" => $student["user_id"]]);

        redirect("/students");
    }
}
