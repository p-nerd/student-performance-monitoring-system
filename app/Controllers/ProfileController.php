<?php

namespace App\Controllers;

use App\Enums\Role;
use App\Services\Student;
use App\Services\User;
use Core\Old;
use Core\Error;
use Core\Validate;

class ProfileController
{
    public function index()
    {
        $user = auth();
        $student = Student::findByUser(db(), $user["id"]);

        return view("pages/profile/index", [
            "user" => $user,
            "student" => $student,
            "designation" => $user["role"] === Role::STUDENT->value ? "Student" : "Other",
        ]);
    }

    public function edit()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }
        $user = auth();

        return view("pages/profile/edit", [
            "user" => $user,
        ]);
    }

    public function update()
    {
        if (!isTeacher()) {
            abort("Your don't have permission to access this", 403);
        }

        $errors = [];

        $name = Validate::string($_POST["name"]);
        $email = Validate::email($_POST["email"]);

        if (!$name) {
            $errors["name"] = "The name is required";
        }
        if (!$email) {
            $errors["email"] = "The email have to be valid";
        }

        $user = auth();

        if ($email !== $user["email"] && User::findByEmail(db(), $email)) {
            $errors["email"] = "The email already exists";
        }

        if (!empty($errors)) {
            Old::set($_POST);
            Error::set("validation error", $errors);
            redirect("/profile/edit");
        }

        db()->query('UPDATE users SET name=:name, email=:email WHERE id=:id', [
            "id" => $user["id"],
            "name" => $name,
            "email" => $email,
        ]);

        redirect("/profile");
    }
}
