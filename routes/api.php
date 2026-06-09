<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BookDetailController;
use App\Http\Controllers\Api\CategoryController; // 🌟 ហៅចូលត្រង់នេះឱ្យមានរបៀប
use App\Http\Controllers\Api\AuthorController;   // 🌟 ហៅចូលត្រង់នេះឱ្យមានរបៀប
use Illuminate\Support\Facades\Route;

// 🌟 មុខងារទាំងនេះគឺតេស្តតាម Postman ទាំងអស់
Route::post('/register', [AuthController::class, 'apiRegister']);
Route::post('/login', [AuthController::class, 'apiLogin']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

// ផ្លូវជាប់ប្រព័ន្ធការពារ (Bearer Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    Route::get('/books/{book_id}/detail', [BookDetailController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'apiLogout']);
    
    // Route::get('/profile', [AuthController::class, 'profile']);

    // 🌟 កែសម្រួលសញ្ញា \ រួចរាល់ លែងមានបន្ទាត់ក្រហមទៀតហើយ
    Route::post('/categories', [CategoryController::class, 'apiStore']);
    Route::get('/categories', [CategoryController::class, 'apiIndex']);

    Route::post('/authors', [AuthorController::class, 'apiStore']);
    Route::get('/authors', [AuthorController::class, 'apiIndex']);
});