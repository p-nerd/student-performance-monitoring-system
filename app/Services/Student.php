<?php

namespace App\Services;

use Core\DB;

class Student
{
    public static function insert(DB $db, array $data): int
    {
        return $db
            ->query(
                "
                    INSERT INTO students(user_id, major)
                    VALUES(:user_id, :major)
                ",
                [
                    "user_id" => $data["user_id"],
                    "major" => $data["major"]
                ]
            )->lastInsertId();
    }

    public static function update(DB $db, int $id, array $data)
    {
        $student = $db
            ->query(
                "
                    SELECT * FROM students
                    WHERE id=:id
                ",
                [
                    "id" => $id
                ]
            )
            ->find();

        return $db
            ->query(
                "
                    UPDATE students
                    SET major=:major
                    WHERE id=:id
                ",
                [
                    "id" => $id,
                    "major" => $data["major"] ?? $student["major"]
                ]
            );
    }

    public static function find(DB $db, int $id): false|array
    {
        return $db
            ->query(
                "
                    SELECT
                        users.id as user_id,
                        users.name as name,
                        users.email as email,
                        users.role as role,
                        users.phone_number AS phone_number,
                        students.id AS student_id,
                        students.major as major
                    FROM students
                    INNER JOIN users ON students.user_id=users.id
                    WHERE students.id=:id
                ",
                [
                    "id" => $id
                ]
            )
            ->find();
    }

    public static function findByUser(DB $db, $userId)
    {
        return $db
            ->query(
                "
                    SELECT *
                    FROM students
                    WHERE user_id=:userId
                ",
                [
                    "userId" => $userId
                ]
            )
            ->find();
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
                        users.phone_number AS phone_number,
                        students.id AS student_id,
                        students.major as major
                    FROM students
                    INNER JOIN users ON students.user_id=users.id
                "
            )->finds();
        return $students;
    }

    public static function courses(DB $db, int $studentId): array
    {
        $courses = $db
            ->query(
                "
                    SELECT
                        student_id, course_id, mark, name, credit, semester
                    FROM student_courses
                    INNER JOIN courses ON student_courses.course_id=courses.id
                    WHERE student_id=:studentId
                ",
                [
                    "studentId" => $studentId
                ]
            )
            ->finds();
        return $courses;
    }

    public static function addPointToCourses(array $courses): array
    {
        $newCourses = [];

        foreach ($courses as $course) {
            $newCourses[] = [...$course, "point" => $course["mark"] ? Course::point($course["mark"]) : null];
        }

        return $newCourses;
    }

    public static function semesters(array $courses): array
    {
        $semesters = [];

        foreach ($courses as $course) {
            $semesters[$course["semester"]] = [...($semesters[$course["semester"]] ?? []), $course];
        }

        return $semesters;
    }

    public static function gpas(array $semesters): array
    {
        $gpas = [];

        foreach ($semesters as $semester => $courses) {
            $gpas[$semester] = Course::gpa($courses);
        }

        return $gpas;
    }
}
