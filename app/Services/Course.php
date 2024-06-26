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
        $sm = array_reduce(
            $courses,
            fn (float $sum, $course) => $sum + (self::point($course["mark"] ?? 0) * $course["credit"]),
            0.0
        );

        $credit_sm = self::creditSum($courses);
        if (!$credit_sm) {
            return 0;
        }
        return self::format($sm / $credit_sm);
    }

    public static function point(int $mark): float
    {
        switch (true) {
            case ($mark >= 90):
                return 4.0;
            case ($mark >= 80):
                return 3.0;
            case ($mark >= 70):
                return 2.0;
            case ($mark >= 60):
                return 1.0;
            default:
                return 0.0;
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
        return array_reduce($courses, fn ($sum, $course) => $sum + $course["credit"], 0);
    }
}
