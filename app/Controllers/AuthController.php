<?php

namespace App\Controllers;

use App\Enums\Role;
use App\Services\User;
use Core\Auth;
use Core\Error;
use Core\Hash;
use Core\Old;
use Core\Validate;


class AuthController
{
    public function register()
    {
        return view("pages/auth/register");
    }

    public function store()
    {
        $errors = [];

        $name = Validate::string($_POST["name"]);
        $email = Validate::email($_POST["email"]);
        $password = Validate::password($_POST["password"]);
        $confirm_password = Validate::password($_POST["confirm_password"]);

        if (!$name) {
            $errors["name"] = "The name is required";
        }
        if (!$email) {
            $errors["email"] = "The email have to be valid";
        }
        if (!$password) {
            $errors["password"] = "The password have to be valid";
        }
        if ($password !== $confirm_password) {
            $errors["confirm_password"] = "The passwords is not matching";
        }

        $user = User::findByEmail(db(), $email);
        if ($user) {
            $errors["email"] = "The email already exists";
        }

        if (!empty($errors)) {
            $old = $_POST;
            $old["password"] = "";
            $old["confirm_password"] = "";
            Old::set($old);
            Error::set("validation error", $errors);
            redirect("/register");
        }

        $user_id = User::insert(db(), [
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "role" => Role::STUDENT->value,
        ]);

        Auth::login($user_id);

        redirect("/profile");
    }



    public function login()
    {
        return view("pages/auth/login");
    }

    public function session()
    {
        $errors = [];

        $email = Validate::email($_POST["email"]);
        $password = Validate::password($_POST["password"]);

        if (!$email) {
            $errors["email"] = "The email have to be valid";
        }
        if (!$password) {
            $errors["password"] = "The password have to be valid";
        }

        $user = User::findByEmail(db(), $email);


        if (!$user) {
            $errors["email"] = "Credential not matching";
            $errors["password"] = "Credential not matching";
        }

        if (!empty($errors)) {
            Old::set($_POST);
            Error::set("validation error", $errors);
            redirect("/login");
        }

        if (!Hash::check($password, $user["password"])) {
            $errors["email"] = "Credential not matching";
            $errors["password"] = "Credential not matching";
        }

        Auth::login($user["id"]);

        redirect("/profile");
    }

    public function logout()
    {
        Auth::logout();

        redirect("/");
    }
}
