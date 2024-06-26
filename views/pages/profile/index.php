<?= layout("header") ?>

<div class="w-full flex justify-between max-w-4xl mx-auto py-8 px-4 md:px-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-[150px] h-[150px] overflow-hidden rounded-full relative">
            <img src="https://avatars.githubusercontent.com/u/67628903?v=4" width="150" alt="Profile Picture" className="w-full rounded-full object-cover rounded-t-2xl" />
        </div>
        <div>
            <h1 class="text-3xl font-bold"><?= $user["name"] ?></h1>
            <p class="text-lg text-muted-foreground"><?= $user["email"] ?> <?= isStudent() ? "| {$student['phone_number']}" : "" ?></p>
        </div>
    </div>
    <div class="flex items-center space-x-3 text-lg">
        <?php if (isStudent()) : ?>
            <a href="/students/result?id=<?= $student['id'] ?>" class="bg-black text-white px-4 py-2 rounded-lg">
                Result
            </a>
        <?php endif ?>
        <a href="/profile/edit" class="bg-black text-white px-4 py-2 rounded-lg">
            Edit Info
        </a>

    </div>
</div>

<?= layout("footer") ?>
