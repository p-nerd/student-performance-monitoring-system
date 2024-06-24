<?php

namespace App\Services;

use Core\DB;

class Student
{
    public static function insert(DB $db, array $data): int
    {
        return $db->query(
            'INSERT INTO students(phone_number, user_id) VALUES(:phone_number, :user_id)',
            [
                "phone_number" => $data["phone_number"],
                "user_id" => $data["user_id"],
            ]
        )->lastInsertId();
    }

    public static function find(DB $db, int $id): false|array
    {
        $student = $db
            ->query(
                "
                    SELECT
                        users.id as user_id,
                        users.name as name,
                        users.email as email,
                        users.role as role,
                        students.id AS student_id,
                        students.phone_number AS phone_number
                    FROM students
                    INNER JOIN users ON students.user_id=users.id
                    WHERE students.id=:id
                ",
                [
                    "id" => $id
                ]
            )
            ->find();
        return $student;
    }

    public static function all(DB $db)
    {
        $students = $db
            ->query(
                "
                    SELECT
                        users.id as user_id,
                        users.name as name,
                        users.email as email,
                        users.role as role,
                        students.id AS student_id,
                        students.phone_number AS phone_number
                    FROM students
                    INNER JOIN users ON students.user_id=users.id
                "
            )->finds();
        return $students;
    }

    public static function courses(DB $db, int $student_id): array
    {
        $courses = $db
            ->query(
                "
                    SELECT
                        student_id, course_id, mark, name, credit, semester
                    FROM student_courses
                    INNER JOIN courses ON student_courses.course_id=courses.id
                    WHERE student_id=:student_id
                ",
                [
                    "student_id" => $student_id
                ]
            )
            ->finds();
        return $courses;
    }

    public static function semesters(array $courses): array
    {
        $semesters = [];
        foreach ($courses as $course) {
            $semesters[$course["semester"]] = [...($semesters[$course["semester"]] ?? []), $course];
        }
        return $semesters;
    }
}
