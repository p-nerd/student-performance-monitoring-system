<?
require_once "../views/layouts/header.php";

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

<div class="w-full max-w-4xl mx-auto space-y-8 py-8  md:px-6">
    <header class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold"><?= $student["first_name"] ?> <?= $student["last_name"] ?></h1>
            <p class="text-muted-foreground">Student ID: <?= $student["id"] ?></p>
        </div>
        <div class="flex items-center gap-4">
            <div class="bg-primary rounded-md px-3 py-1 text-primary-foreground text-sm font-medium">CGPA: 3.6</div>
        </div>
    </header>
    <?php foreach ($semesters as $semester => $courses) : ?>
        <div class="border-b-4 ">
            <div class="flex justify-between">
                <h2>Semester: <?= $semester ?></h2>
                <div class="bg-primary rounded-md py-1 text-primary-foreground text-sm font-medium">GPA: 3.8</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-muted">
                            <th class="py-3 text-left text-sm font-medium text-muted-foreground">Course</th>
                            <th class="py-3 text-left text-sm font-medium text-muted-foreground">Credit</th>
                            <th class="py-3 text-right text-sm font-medium text-muted-foreground">Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course) : ?>
                            <tr class="border-b">
                                <td class="py-3 text-left"><?= $course["name"] ?></td>
                                <td class="py-3 text-left"><?= $course["credit"] ?></td>
                                <td class="py-3 text-right"><?= $course["mark"] ?? "-" ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?
require_once "../views/layouts/footer.php";
?>
