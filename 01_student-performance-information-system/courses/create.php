<?php
require_once "../views/layouts/header.php";
?>
<div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md" data-v0-t="card">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Course Registration</h3>
        <p class="text-sm text-muted-foreground">Fill out the form below to register as a new course.</p>
    </div>
    <form class="p-6 space-y-4" method="post" action="/courses/store.php">
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                Name
            </label>
            <input value="<?= $old("name") ?>" name="name" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="email" placeholder="Enter your email" type="text" />
            <span class="text-xs text-red-500"><?= $error('name') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="credit">
                Credit
            </label>
            <input value="<?= $old("credit") ?>" id="credit" name="credit" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your phone number" type="number" />

            <span class="text-xs text-red-500"><?= $error('credit') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="semester">
                Semester
            </label>
            <input value="<?= $old("semester") ?>" id="semester" name="semester" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your phone number" type="number" />

            <span class="text-xs text-red-500"><?= $error('semester') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="mark">
                Mark
            </label>
            <input value="<?= $old("mark") ?>" id="mark" name="mark" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Enter your phone number" type="number" />

            <span class="text-xs text-red-500"><?= $error('mark') ?></span>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-black text-white rounded">Create Course</button>
    </form>
</div>

<?php
require_once "../views/layouts/footer.php";
?>
