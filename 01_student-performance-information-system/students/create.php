<?php
require_once "../views/layouts/header.php";
?>
<div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md" data-v0-t="card">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Student Registration</h3>
        <p class="text-sm text-muted-foreground">Fill out the form below to register as a new student.</p>
    </div>
    <form class="p-6 space-y-4" method="post" action="/students/store.php">
        <div class="grid grid-cols-2 gap-4">
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="firstName">
                    First Name
                </label>
                <input value="<?= $old("first_name") ?>" name="first_name" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="firstName" placeholder="Enter your first name" />

                <span class="text-xs text-red-500"><?= $error('first_name') ?></span>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="lastName">
                    Last Name
                </label>
                <input value="<?= $old("last_name") ?>" name="last_name" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="lastName" placeholder="Enter your last name" />

                <span class="text-xs text-red-500"><?= $error('last_name') ?></span>
            </div>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                Email
            </label>
            <input value="<?= $old("email") ?>" name="email" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="email" placeholder="Enter your email" type="email" />
            <span class="text-xs text-red-500"><?= $error('email') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="phone">
                Phone Number
            </label>
            <input value="<?= $old("phone_number") ?>" name="phone_number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="phone" placeholder="Enter your phone number" type="tel" />

            <span class="text-xs text-red-500"><?= $error('phone_number') ?></span>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-black text-white rounded">Create Student</button>
    </form>
</div>

<?php
require_once "../views/layouts/footer.php";
?>
