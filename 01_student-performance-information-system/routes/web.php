<?php

use Core\Route;
use App\Controllers\HomeController;

Route::get("/", [HomeController::class, "index"]);
