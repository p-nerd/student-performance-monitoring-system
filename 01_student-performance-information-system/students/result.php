<?
require __DIR__ . "/../views/layouts/header.php";

$id = $_REQUEST["id"];

$student = $db
    ->query("SELECT * FROM students WHERE id=:id", ["id" => $id])
    ->find();

$courses = $db
    ->query("SELECT * FROM student_courses INNER JOIN courses ON student_courses.course_id=courses.id WHERE student_id=:student_id", [
        "student_id" => $id
    ])
    ->finds();

$semesters = [];

foreach ($courses as $course) {
    $semesters[$course["semester"]] = [...($semesters[$course["semester"]] ?? []), $course];
}

?>

<div class="w-full max-w-4xl mx-auto space-y-10 py-8  md:px-6">
    <header class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold"><?= $student["first_name"] ?> <?= $student["last_name"] ?></h1>
            <p class="text-muted-foreground">Student ID: <?= $student["id"] ?></p>
        </div>
        <div class="flex items-center gap-4">
            <div class="bg-primary rounded-md px-3 py-1 text-primary-foreground text-lg font-medium">CGPA: <?= \App\Course::cgpa($courses) ?></div>
        </div>
    </header>
    <?php

    use App\Course;

    foreach ($semesters as $semester => $courses) : ?>
        <div class="space-y-4">
            <h2 class="text-lg font-semibold">Semester: <?= $semester ?></h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-muted">
                            <th class="py-3 text-left text-sm font-medium text-muted-foreground">Course</th>
                            <th class="py-3 text-left text-sm font-medium text-muted-foreground">Credit</th>
                            <th class="py-3 text-left text-sm font-medium text-muted-foreground">Marks</th>
                            <th class="py-3 text-right text-sm font-medium text-muted-foreground">Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course) : ?>
                            <tr class="border-b">
                                <td class="py-3 text-left"><?= $course["name"] ?></td>
                                <td class="py-3 text-left"><?= $course["credit"] ?></td>
                                <td class="py-3 text-left"><?= $course["mark"] ?? "-" ?></td>
                                <td class="py-3 text-right"><?= Course::point($course["mark"] ?? 0) ?? "-" ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="text-lg bg-primary rounded-md py-1 text-end text-primary-foreground font-medium">GPA: <?= Course::gpa($courses) ?></div>
        </div>
    <?php endforeach ?>
</div>
<?
require __DIR__ . "/../views/layouts/footer.php";
?>
