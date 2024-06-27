<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student performance monitoring system</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="flex h-20 w-full shrink-0 items-center px-4 md:px-6">
        <div class="w-[150px]">
            <a class="mr-6 flex items-center" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                    <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
                </svg>
                <span class="sr-only">Acme Inc</span>
            </a>
        </div>
        <nav class="ml-auto flex gap-4 sm:gap-6">
            <?php if (isTeacher()) : ?>
                <?= component("nav-link", ["label" => "Students", "href" => "/students"]) ?>
                <?= component("nav-link", ["label" => "Courses", "href" => "/courses"]) ?>
            <?php endif ?>

            <?php if (!auth()) : ?>
                <?= component("nav-link", ["label" => "Register", "href" => "/register"]) ?>
                <?= component("nav-link", ["label" => "Login", "href" => "/login"]) ?>
            <?php else : ?>
                <?= component("nav-link", ["label" => "Profile", "href" => "/profile"]) ?>
                <form method="post" action="/logout" class="flex flex-col items-center justify-center">
                    <button type="submit" class="text-sm font-medium hover:underline underline-offset-4" href="/logout">
                        Logout
                    </button>
                </form>

            <?php endif ?>
        </nav>
    </header>
    <main class="container mx-auto flex flex-col justify-center items-center" style="min-height: calc(100vh - 224px);">
