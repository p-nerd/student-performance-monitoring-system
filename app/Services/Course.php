<?php

namespace App\Services;

use Core\DB;

class Course
{
    public static function cgpa(array $courses): float
    {
        return self::gpa($courses);
    }
    public static function gpa(array $courses): float
    {

        $sum = array_reduce(
            $courses,
            function (float $sum, $course) {
                if (!$course["mark"]) {
                    return $sum;
                }
                return $sum + (self::point($course["mark"] ?? 0) * $course["credit"]);
            },
            0.0
        );

        $creditSum = self::creditSum($courses);

        if (!$creditSum) {
            return 0;
        }

        return self::format($sum / $creditSum);
    }

    public static function point(int $mark): float
    {
        // Ensure mark is within valid range
        if ($mark < 0 || $mark > 100) {
            return 0.0;
        }

        switch (true) {
            case ($mark >= 80 && $mark <= 100):
                return 4.0; // A+
            case ($mark >= 75 && $mark <= 79):
                return 3.75; // A
            case ($mark >= 70 && $mark <= 74):
                return 3.5; // A-
            case ($mark >= 65 && $mark <= 69):
                return 3.25; // B+
            case ($mark >= 60 && $mark <= 64):
                return 3.0; // B
            case ($mark >= 55 && $mark <= 59):
                return 2.75; // B-
            case ($mark >= 50 && $mark <= 54):
                return 2.5; // C+
            case ($mark >= 45 && $mark <= 49):
                return 2.25; // C
            case ($mark >= 40 && $mark <= 44):
                return 2.0; // D
            default:
                return 0.0; // F
        }
    }

    public static function all(DB $db)
    {
        return $db
            ->query(
                "
                    SELECT *
                    FROM courses;
                "
            )
            ->finds();
    }

    public static function findsByStudent(DB $db, $student_id)
    {
        return $db
            ->query(
                "
                    SELECT student_id, course_id, mark, name, credit, semester
                    FROM student_courses
                    INNER JOIN courses ON student_courses.course_id=courses.id
                    WHERE student_id=:student_id
                ",
                [
                    "student_id" => $student_id
                ]
            )
            ->finds();
    }

    protected static function format(float $number): float
    {
        return  number_format($number, 2);
    }

    protected static function creditSum($courses): int
    {
        return array_reduce($courses, function ($sum, $course) {
            if (!$course["mark"]) {
                return $sum;
            }
            return $sum + $course["credit"];
        }, 0);
    }
}
