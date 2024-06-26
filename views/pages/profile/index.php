<?= layout("header") ?>

<div class="w-full flex justify-between max-w-4xl mx-auto py-8 px-4 md:px-6">
    <div class="flex items-center gap-4 mb-6">
        <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
            <img class="aspect-square bg-black h-full w-full" />
        </span>
        <div>
            <h1 class="text-2xl font-bold"><?= $user["name"] ?></h1>
            <p class="text-muted-foreground"><?= $user["email"] ?> <?= isStudent() ? "| {$student['phone_number']}" : "" ?></p>
        </div>
    </div>
    <div class="flex items-center space-x-3">
        <?php if (isStudent()) : ?>
            <a href="/students/result?id=<?= $student['id'] ?>" class="bg-black text-white px-4 py-2 rounded-lg">
                Result
            </a>
            <a href="/students/edit?id=<?= $student['id'] ?>" class="bg-black text-white px-4 py-2 rounded-lg">
                Edit Info
            </a>
        <?php else : ?>
            <a href="/profile/edit" class="bg-black text-white px-4 py-2 rounded-lg">
                Edit Info
            </a>
        <?php endif ?>

    </div>
</div>

<?= layout("footer") ?>
