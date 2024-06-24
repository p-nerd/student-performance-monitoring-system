<?php

namespace App\Services;

use App\Enums\Role;
use Core\DB;
use Core\Hash;

class User
{
    public static function insert(DB $db, array $data): int
    {
        return $db->query(
            'INSERT INTO users(name, email, password, role) VALUES(:name, :email, :password, :role)',
            [
                "name" => $data["name"],
                "email" => $data["email"],
                "password" => Hash::make($data["password"]),
                "role" => $data["role"] || Role::STUDENT->value,
            ]
        )->lastInsertId();
    }

    public static function findByEmail(DB $db, string $email): false|array
    {
        return $db->query("SELECT * FROM users WHERE email=:email", ["email" => $email])->find();
    }
}
