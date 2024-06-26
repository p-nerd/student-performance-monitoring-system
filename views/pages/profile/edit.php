<?= layout("header") ?>

<div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md" data-v0-t="card">
    <div class="flex flex-col space-y-1.5 pt-6 px-6">
        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Edit Profile</h3>
        <p class="text-sm text-muted-foreground">Fill out the form below to update the profile.</p>
    </div>
    <form class="p-6 space-y-4" method="post" action="/profile" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="patch" />
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="name">
                Name
            </label>
            <input value="<?= old("name") ?? $user['name'] ?>" name="name" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="name" placeholder="Enter your name" />

            <span class="text-xs text-red-500"><?= error('name') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                Email
            </label>
            <input value="<?= old("email") ?? $user['email'] ?>" name="email" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="email" placeholder="Enter your email" type="email" />
            <span class="text-xs text-red-500"><?= error('email') ?></span>
        </div>
        <div class="space-y-2">
            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="phone">
                Phone Number
            </label>
            <input value="<?= old("phone_number") ?? $user['phone_number'] ?>" name="phone_number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="phone" placeholder="Enter your phone number" type="tel" />

            <span class="text-xs text-red-500"><?= error('phone_number') ?></span>
        </div>
        <div class="flex w-full space-x-2 items-center">
            <div>
                <?= component("profile-picture", ["src" => image($user["avatar"])]) ?>
            </div>
            <div class="mb-3">
                <label for="formFileSm" class="mb-2 inline-block text-neutral-500">Select Image</label>
                <input name="pricture" class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none" id="upload-profile-picture" type="file" />
                <span class="text-xs text-red-500"><?= error('avatar') ?></span>
            </div>
        </div>
        <button type="submit" class="w-full py-2 px-4 bg-black text-white rounded">Update</button>
    </form>
</div>

<?= layout("footer") ?>
