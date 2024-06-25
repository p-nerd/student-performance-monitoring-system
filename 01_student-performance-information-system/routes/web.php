<?php

use Core\Route;
use App\Controllers\AuthController;
use App\Controllers\HomeController;

Route::get("/", [HomeController::class, "index"]);
Route::get("/profile", [HomeController::class, "index"]);

// auth
Route::get("/register", [AuthController::class, "register"]);
Route::post("/register", [AuthController::class, "store"]);

Route::get("/login", [AuthController::class, "login"]);
Route::post("/login", [AuthController::class, "session"]);

Route::post("/logout", [AuthController::class, "logout"]);
