<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

// បើកដំណើរការផ្លូវ UI Books

// បង្ហាញបញ្ជីសៀវភៅ (កិច្ចការចាស់ដែលបានធ្វើរួច)
Route::get('/ui/books', [BookController::class, 'uiIndex'])->name('books.ui');

// ១. Route សម្រាប់បង្ហាញទំព័រ Form បង្កើតសៀវភៅថ្មី (GET)
Route::get('/ui/books/create', [BookController::class, 'uiCreate'])->name('books.ui.create');

// ២. Route សម្រាប់ទទួលទិន្នន័យពី Form យកទៅរក្សាទុក (POST)
Route::post('/ui/books/store', [BookController::class, 'uiStore'])->name('books.ui.store');

// ៣. Route សម្រាប់បង្ហាញព័ត៌មានលម្អិតសៀវភៅ (Detail)
Route::get('/ui/books/{id}', [BookController::class, 'uiShow'])->name('books.ui.show');

// ៤. Route សម្រាប់បង្ហាញ Form កែប្រែទិន្នន័យ (Edit)
Route::get('/ui/books/{id}/edit', [BookController::class, 'uiEdit'])->name('books.ui.edit');

// ៥. Route សម្រាប់ទទួលទិន្នន័យដែលបានកែប្រែយកទៅរក្សាទុក (Update)
Route::put('/ui/books/{id}', [BookController::class, 'uiUpdate'])->name('books.ui.update');

// ៦. Route សម្រាប់លុបទិន្នន័យសៀវភៅ (Delete)
Route::delete('/ui/books/{id}', [BookController::class, 'uiDestroy'])->name('books.ui.destroy');

Route::get('/', function () {
    return view('welcome');
});
