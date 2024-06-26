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
            "
                INSERT INTO users(name, email, password, role, phone_number)
                VALUES(:name, :email, :password, :role, :phone_number)
            ",
            [
                "name" => $data["name"],
                "email" => $data["email"],
                "password" => Hash::make($data["password"]),
                "role" => $data["role"] || Role::GUEST->value,
                "phone_number" => $data["phone_number"]
            ]
        )->lastInsertId();
    }

    public static function update(DB $db, int $id, array $data)
    {
        $user = static::find($db, $id);

        $db->query(
            "
                UPDATE users
                SET name=:name, email=:email, phone_number=:phone_number, avatar=:avatar
                WHERE id=:id
            ",
            [
                "id" => $id,
                "name" => $data["name"] ?? $user["name"],
                "email" => $data["email"] ?? $user["email"],
                "phone_number" => $data["phone_number"] ?? $user["phone_number"],
                "avatar" => $data["avatar"] ?? $user["avatar"]
            ]
        );
    }

    public static function finds(DB $db): array
    {
        return $db->query("SELECT * FROM users")->finds();
    }

    public static function findsByRole(DB $db, string $role): false|array
    {
        return $db->query("SELECT * FROM users WHERE role=:role", ["role" => $role])->finds();
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
