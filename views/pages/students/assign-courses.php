<?= layout("header") ?>

<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="space-y-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Assign Courses to <?= $student["name"] ?></h1>
        </div>
        <?php if (!parray($leftCourses)->isEmpty()) : ?>
            <form method="post" method="/students/assign-courses" class="w-full flex justify-between">
                <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>" />
                <select name="course_id" class="mr-5 flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    <option value="">Select Course</option>
                    <?php foreach ($leftCourses as $course) : ?>
                        <option value="<?= $course['id'] ?>"><?= $course['name'] ?> (<?= $course["credit"] ?>)</option>
                    <?php endforeach ?>
                </select>
                <button class="bg-black text-white rounded-md px-3 py-1" type="submit">
                    Assign
                </button>
            </form>
        <?php else : ?>
            <div class="text-center text-gray-700">All courses are already assign to <?= $student["name"] ?></div>
        <?php endif ?>
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900">Assigned Courses</h2>
            <ul class="mt-3 space-y-3">
                <?php foreach ($assignedCourses as $course) : ?>
                    <li class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 h-5 w-5 text-gray-400">
                                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path>
                            </svg>
                            <span class="ml-3 text-sm font-medium text-gray-900"><?= $course["name"] ?> (<?= $course["credit"] ?>)</span>
                        </div>
                        <form method="post" action="/students/assign-courses">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>" />
                            <input type="hidden" name="course_id" value="<?= $course['course_id'] ?>" />
                            <button type="submit" class="bg-black text-white rounded-md px-3 py-1">
                                Remove
                            </button>
                        </form>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>

<?= layout("footer") ?>
