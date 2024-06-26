<?php

namespace App\Controllers;

use Core\Error;
use Core\Old;
use Core\Validate;


class CourseController
{
    public function index()
    {
        $courses = db()->query("SELECT * FROM courses")->finds();

        return view("pages/courses/index", [
            'courses' => $courses
        ]);
    }

    public function create()
    {
        return view("pages/courses/create");
    }

    public function store()
    {
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
            redirect("/courses/create");
        }

        db()->query('INSERT INTO courses(name, credit, semester) VALUES(:name, :credit, :semester)', [
            "name" => $name,
            "credit" => $credit,
            "semester" => $semester,
        ]);

        redirect("/courses");
    }
    public function edit()
    {
        $id = $_REQUEST["id"];

        $course = db()->query("SELECT * FROM courses WHERE id=:id", ["id" => $id])->find();

        return view("pages/courses/edit", [
            "id" => $id,
            "course" => $course
        ]);
    }

    function update()
    {
        $id = $_REQUEST["id"];

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
            redirect("/courses/edit.php?id=$id");
        }

        db()->query('UPDATE courses SET name=:name, credit=:credit, semester=:semester WHERE id=:id', [
            "id" => $id,
            "name" => $name,
            "credit" => $credit,
            "semester" => $semester,
        ]);

        redirect("/courses");
    }

    public function destory()
    {
        $id = $_REQUEST["id"];

        db()->query("DELETE FROM student_courses WHERE course_id=:id", ["id" => $id]);
        db()->query("DELETE FROM courses WHERE id=:id", ["id" => $id]);

        redirect("/courses");
    }
}
