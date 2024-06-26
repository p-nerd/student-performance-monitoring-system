<?= layout("header") ?>

<div class="w-full max-w-4xl mx-auto space-y-10 py-8  md:px-6">
    <header class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold"><?= $student["name"] ?></h1>
            <p>Student ID: <?= $student["student_id"] ?></p>
            <div>CGPA: <?= $cgpa ?></div>
        </div>
        <div>
            <form method="post" action="/students/download?id=<?= $id ?>">
                <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg">Download</button>
            </form>
        </div>
    </header>

    <?php if (!$courses) : ?>
        <div class="text-center text-gray-500">There is no course for this student</div>
    <?php endif ?>

    <?php foreach ($semesters as $semester => $courses) : ?>
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
                                <td class="py-3 text-right"><?= $course["point"] ?? "-" ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="text-lg bg-primary rounded-md py-1 text-end text-primary-foreground font-medium">GPA: <?= $gpas[$semester] ?></div>
        </div>
    <?php endforeach ?>
</div>

<?= layout("footer") ?>
