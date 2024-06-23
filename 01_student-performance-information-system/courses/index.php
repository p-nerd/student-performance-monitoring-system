<?php
require_once "../views/layouts/header.php";

$courses = $db->query("SELECT * FROM courses")->finds();

?>

<div class="w-full max-w-4xl pt-10 mx-auto">
    <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">

        <div class="p-6 flex justify-between">
            <div class="flex flex-col space-y-1.5 ">
                <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Courses</h3>
                <p class="text-sm text-muted-foreground">View and manage courses.</p>
            </div>
            <div>
                <a href="/courses/create.php" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-black text-white hover:bg-accent hover:text-accent-foreground h-10 rounded-md px-3" color="destructive">
                    Add new course
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm">
                    <thead class="[&amp;_tr]:border-b">
                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Name
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Credit
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Mark
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0" <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">

                            </th>
                        </tr>
                    </thead>
                    <tbody class="[&amp;_tr:last-child]:border-0">
                        <?php foreach ($courses as $course) : ?>
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?= $course["name"] ?></td>
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?= $course["credit"] ?></td>
                                <td class="p-4 align-middle [&amp;:has([role=checkbox]j]:pr-0"><?= $course["mark"] ?? '-' ?></td>
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="/courses/edit.php?id=<?= $course['id'] ?>" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                                            Edit
                                        </a>
                                        <a href="/courses/destroy.php?id=<?= $course['id'] ?>" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" color="destructive">
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once "../views/layouts/footer.php";
?>
