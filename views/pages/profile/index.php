<?= layout("header") ?>



<div class="w-full max-w-4xl mx-auto py-8 px-4 md:px-6">
    <div class="flex items-center gap-4 mb-6">
        <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
            <img class="aspect-square bg-black h-full w-full" />
        </span>
        <div>
            <h1 class="text-2xl font-bold"><?= $user["name"] ?></h1>
            <?php if ($cgpa) : ?>
                <p class="text-muted-foreground">CGPA: <?= $cgpa ?></p>
            <?php endif ?>
        </div>
    </div>
</div>

<?= layout("footer") ?>
