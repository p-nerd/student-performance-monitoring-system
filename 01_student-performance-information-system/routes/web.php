<?php

use Core\Route;
use App\Controllers\HomeController;

Route::get("/", [HomeController::class, "index"]);

Route::get("/about", function () {
    return "this is about";
});
