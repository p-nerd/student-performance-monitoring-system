<?php

use Core\Route;
use App\Controllers\AuthController;
use App\Controllers\CourseController;
use App\Controllers\HomeController;
use App\Controllers\ProfileController;
use App\Controllers\StudentController;

Route::get("/", [HomeController::class, "index"]);


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

// courses
Route::get("/courses", [CourseController::class, "index"]);

Route::get("/courses/create", [CourseController::class, "create"]);
Route::post("/courses", [CourseController::class, "store"]);

Route::get("/courses/edit", [CourseController::class, "edit"]);
Route::patch("/courses", [CourseController::class, "update"]);

Route::delete("/courses", [CourseController::class, "destory"]);

// profile
Route::get("/profile", [ProfileController::class, "index"]);
