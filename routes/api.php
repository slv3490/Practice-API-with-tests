<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource("books", BookController::class);
    Route::post("/books/filter-by-author", [BookController::class, "filtered"])->name("books.filtered");
    Route::post("/books/{id}/borrow", [BookController::class, "borrow"])->name("books.borrow");
});
Route::post("/user/create", [UserController::class, "createUser"]);