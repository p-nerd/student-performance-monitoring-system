<?php

namespace App\Controllers;

use App\Enums\Role;

class ProfileController
{
    public function index()
    {
        $user = auth();

        return view("pages/profile/index", [
            "designation" => $user["role"] === Role::STUDENT->value ? "Student" : "Other",
            "user" => $user,
            "cgpa" => null,
        ]);
    }
}
