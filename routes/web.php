<?php
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

// ទំព័រ Login & Register មិនបាច់ជាប់ការពារទេ
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'webLogout'])->name('logout');

// 🌟 បើក Route សម្រាប់ចុះឈ្មោះលើ UI ឡើងវិញ
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'webRegister'])->name('register.perform');

// ដាក់ការពារទំព័រ UI ទាំងអស់ លុះត្រាតែ Login រួចរាល់លើ Web
Route::middleware('auth')->group(function () {
    Route::get('/ui/books', [BookController::class, 'uiIndex'])->name('books.ui');
    Route::get('/ui/books/create', [BookController::class, 'uiCreate'])->name('books.ui.create');
    Route::post('/ui/books/store', [BookController::class, 'uiStore'])->name('books.ui.store');
    Route::get('/ui/books/{id}', [BookController::class, 'uiShow'])->name('books.ui.show');
    Route::get('/ui/books/{id}/edit', [BookController::class, 'uiEdit'])->name('books.ui.edit');
    Route::put('/ui/books/{id}', [BookController::class, 'uiUpdate'])->name('books.ui.update');
    Route::delete('/ui/books/{id}', [BookController::class, 'uiDestroy'])->name('books.ui.destroy');
    Route::get('/ui/books/{book_id}/detail/edit', [\App\Http\Controllers\Api\BookDetailController::class, 'uiEdit'])->name('book-details.ui.edit');
    Route::put('/ui/book-details/{id}', [\App\Http\Controllers\Api\BookDetailController::class, 'uiUpdate'])->name('book-details.ui.update');

    Route::get('/ui/categories/create', [\App\Http\Controllers\Api\CategoryController::class, 'uiCreate'])->name('categories.ui.create');
    Route::post('/ui/categories/store', [\App\Http\Controllers\Api\CategoryController::class, 'uiStore'])->name('categories.ui.store');

    // Form សម្រាប់ Author
    Route::get('/ui/authors/create', [\App\Http\Controllers\Api\AuthorController::class, 'uiCreate'])->name('authors.ui.create');
    Route::post('/ui/authors/store', [\App\Http\Controllers\Api\AuthorController::class, 'uiStore'])->name('authors.ui.store');

    Route::get('/store', function () {
        $books = \App\Models\Book::with('category')->get();
        return view('books.user_index', compact('books'));
    })->name('store.public');
});

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('books.ui');
        }
        return redirect()->route('store.public');
    }
    return redirect()->route('login');
});
