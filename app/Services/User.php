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

    public static function update(DB $db, int $id, array $data)
    {
        $db->query(
            "
                UPDATE users
                SET name=:name, email=:email, phone_number=:phone_number, avatar=:avatar
                WHERE id=:id
            ",
            [
                "id" => $id,
                "name" => $data["name"],
                "email" => $data["email"],
                "phone_number" => $data["phone_number"],
                "avatar" => $data["avatar"]
            ]
        );
    }

    public static function find(DB $db, int $id): false|array
    {
        return $db->query("SELECT * FROM users WHERE id=:id", ["id" => $id])->find();
    }

    public static function findByEmail(DB $db, string $email): false|array
    {
        return $db->query("SELECT * FROM users WHERE email=:email", ["email" => $email])->find();
    }
}
