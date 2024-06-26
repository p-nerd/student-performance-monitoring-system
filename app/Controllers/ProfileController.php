<?php

namespace App\Controllers;

use App\Enums\Role;
use App\Services\Student;
use App\Services\User;
use Core\Old;
use Core\Error;
use Core\Image;
use Core\Validate;
use Exception;

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
        $user = auth();

        return view("pages/profile/edit", [
            "user" => $user,
        ]);
    }

    public function update()
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
            $errors["phone_number"] = "The phone number have to be valid";
        }

        $user = auth();

        if ($email !== $user["email"] && User::findByEmail(db(), $email)) {
            $errors["email"] = "The email already exists";
        }

        if (Image::isExist($_FILES["pricture"])) {
            try {
                $avatar = Image::save($_FILES["pricture"]);
            } catch (Exception $e) {
                $errors["avatar"] = $e->getMessage();
            }
        } else {
            $avatar = $user["avatar"];
        }

        if (!empty($errors)) {
            Old::set($_POST);
            Error::set("validation error", $errors);
            redirect("/profile/edit");
        }

        User::update(db(), $user["id"], [
            "name" => $name,
            "email" => $email,
            "phone_number" => $phone_number,
            "avatar" => $avatar
        ]);

        redirect("/profile");
    }
}
