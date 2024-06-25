<?php

require __DIR__ . "/../vendor/autoload.php";

Core\Env::load();

session_start();

require __DIR__ . "/../core/helper.php";
require __DIR__ . "/../routes/web.php";

echo \Core\Route::resolve();

Core\Error::reset();
Core\Old::reset();
