<?= layout("header") ?>

<div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md">
    <div class="flex flex-col space-y-1.5 px-6 pt-6">
        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Login</h3>
        <p class="text-sm text-muted-foreground">Fill out the form below to login into the system.</p>
    </div>
    <form class="p-6 space-y-4" method="post" action="/login">
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                Email
            </label>
            <input value="<?= old("email") ?>" name="email" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="email" placeholder="Enter your email" type="email" />
            <span class="text-xs text-red-500"><?= error('email') ?></span>
        </div>
        <div class="space-y-2">
            <label for="password" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                Password
            </label>
            <input value="<?= old("password") ?>" name="password" id="phone" placeholder="Enter a password" type="password" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" />
            <span class="text-xs text-red-500"><?= error('password') ?></span>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-black text-white rounded">Login</button>
    </form>
</div>

<?= layout("footer") ?>
