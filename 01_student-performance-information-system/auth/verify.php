<?php

require __DIR__ . "/../boot.php";

use App\Services\User;
use Core\Auth;
use Core\Error;
use Core\Hash;
use Core\Old;
use Core\Validate;

$errors = [];

$email = Validate::email($_POST["email"]);
$password = Validate::password($_POST["password"]);

if (!$email) {
    $errors["email"] = "The email have to be valid";
}
if (!$password) {
    $errors["password"] = "The password have to be valid";
}

$user = User::findByEmail($db, $email);

if (!$user) {
    $errors["email"] = "Credential not matching";
    $errors["password"] = "Credential not matching";
}
if (!Hash::check($password, $user["password"])) {
    $errors["email"] = "Credential not matching";
    $errors["password"] = "Credential not matching";
}

if (!empty($errors)) {
    Old::set($_POST);
    Error::set("validation error", $errors);
    redirect("/auth/register.php");
}

Auth::login($user["id"]);

redirect("/profile");
