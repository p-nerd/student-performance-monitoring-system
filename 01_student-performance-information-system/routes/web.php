<?php

use Core\Route;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\StudentController;

Route::get("/", [HomeController::class, "index"]);
Route::get("/profile", [HomeController::class, "index"]);

// auth
Route::get("/register", [AuthController::class, "register"]);
Route::post("/register", [AuthController::class, "store"]);

Route::get("/login", [AuthController::class, "login"]);
Route::post("/login", [AuthController::class, "session"]);

Route::post("/logout", [AuthController::class, "logout"]);

// students
Route::get("/students", [StudentController::class, "index"]);
Route::get("/students/result", [StudentController::class, "result"]);
Route::post("/students/download", [StudentController::class, "download"]);

Route::get("/students/create", [StudentController::class, "create"]);
Route::post("/students", [StudentController::class, "store"]);

Route::get("/students/edit", [StudentController::class, "edit"]);
Route::patch("/students", [StudentController::class, "update"]);

Route::delete("/students", [StudentController::class, "destory"]);
