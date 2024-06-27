<?= layout("header") ?>

<div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md" data-v0-t="card">
    <div class="flex flex-col space-y-1.5 pt-6 px-6">
        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Edit Student</h3>
        <p class="text-sm text-muted-foreground">Fill out the form below to update the student.</p>
    </div>
    <form class="p-6 space-y-4" method="post" action="/students?id=<?= $id ?>">
        <input type="hidden" name="_method" value="patch" />
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                Name
            </label>
            <input value="<?= old("name") ?? $student['name'] ?>" name="name" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="name" placeholder="Enter your name" />

            <span class="text-xs text-red-500"><?= error('name') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                Email
            </label>
            <input value="<?= old("email") ?? $student['email'] ?>" name="email" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="email" placeholder="Enter your email" type="email" />
            <span class="text-xs text-red-500"><?= error('email') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="phone">
                Phone Number
            </label>
            <input value="<?= old("phone_number") ?? $student['phone_number'] ?>" name="phone_number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="phone" placeholder="Enter your phone number" type="tel" />

            <span class="text-xs text-red-500"><?= error('phone_number') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="major">
                Major
            </label>
            <input value="<?= old("major") ?? $student['major'] ?>" name="major" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="major" placeholder="Enter student major" />
            <span class="text-xs text-red-500"><?= error('major') ?></span>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-black text-white rounded">Update Student</button>
    </form>
</div>

<?= layout("footer") ?>
