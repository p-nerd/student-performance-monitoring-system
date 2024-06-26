<div class="w-[150px] h-[150px] overflow-hidden rounded-full relative">
    <?php if ($src) : ?>
        <img src="<?= $src ?>" width="150" alt="Profile Picture" class="w-full rounded-full object-cover" />
    <?php else : ?>
        <div class="w-[150px] h-[150px] bg-black"></div>
    <?php endif ?>
</div>
