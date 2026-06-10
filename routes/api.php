<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BookDetailController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

// 🌟 ផ្លូវទូទៅ (Public) លែងត្រូវការ Token សម្រាប់មើលបញ្ជីសៀវភៅ និងការ Login/Register
Route::post('/register', [AuthController::class, 'apiRegister']);
Route::post('/login', [AuthController::class, 'apiLogin']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

// 🔐 ផ្លូវជាប់ប្រព័ន្ធការពារ (ទាមទារ Bearer Token ដាច់ខាត)
Route::middleware('auth:sanctum')->group(function () {
    // ----------------------------------------------------
    // 👥 ក្រុមទី ១៖ មុខងាររួម (ទាំង Admin និង Staff អាចហៅបានដូចគ្នា)
    // ----------------------------------------------------
    Route::post('/logout', [AuthController::class, 'apiLogout']);
    Route::get('/profile', [AuthController::class, 'profile']);  // បើកដំណើរការឡើងវិញ
    Route::get('/categories', [CategoryController::class, 'apiIndex']);
    Route::get('/authors', [AuthorController::class, 'apiIndex']);

    // ----------------------------------------------------
    // ⚡ ក្រុមទី ២៖ មុខងារពិសេស (🔒 សម្រាប់តែ ADMIN តែប៉ុណ្ណោះ)
    // ----------------------------------------------------
    Route::middleware('role:admin')->group(function () {
        // គ្រប់គ្រងសៀវភៅ (CRUD)
        Route::post('/books', [BookController::class, 'store']);
        Route::put('/books/{id}', [BookController::class, 'update']);
        Route::delete('/books/{id}', [BookController::class, 'destroy']);
        Route::get('/books/{book_id}/detail', [BookDetailController::class, 'show']);

        // គ្រប់គ្រង Categories និង Authors
        Route::post('/categories', [CategoryController::class, 'apiStore']);
        Route::post('/authors', [AuthorController::class, 'apiStore']);
    });
});
