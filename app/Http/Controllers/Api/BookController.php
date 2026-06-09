<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // ==========================================
    // ផ្នែកទី ១៖ សម្រាប់ប្រព័ន្ធ API (Postman)
    // ==========================================

    public function index()
    {
        // មេរៀនទី ៥ តម្រូវឱ្យប្រើ Pagination និង API Resource Collection
        $books = Book::with(['category', 'authorRelation', 'detail'])->paginate(10);
        return BookResource::collection($books);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        $authorModel = Author::find($validated['author_id']);

        $book = Book::create([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'author' => $authorModel ? $authorModel->name : 'Unknown Author',
        ]);

        if ($request->hasFile('cover_image')) {
            $book->cover_image = $request->file('cover_image')->store('books', 'public');
            $book->save();
        }

        BookDetail::create([
            'book_id' => $book->id,
            'description' => $validated['description'] ?? 'មិនមានការពិពណ៌នា',
            'publisher' => 'រោងពុម្ពលំនាំដើម',
            'language' => 'Khmer',
            'page_count' => 0
        ]);

        return (new BookResource($book))->additional(['message' => 'បានបង្កើតសៀវភៅតាម API ជោគជ័យ'])->response()->setStatusCode(201);
    }

    public function show(string $id)
    {
        $book = Book::with(['category', 'authorRelation', 'detail'])->find($id);
        if (!$book) {
            return response()->json(['message' => 'រកមិនឃើញសៀវភៅឡើយ!'], 404);
        }
        return new BookResource($book);
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image)
                Storage::disk('public')->delete($book->cover_image);
            $book->cover_image = $request->file('cover_image')->store('books', 'public');
        }

        $authorModel = Author::find($validated['author_id']);
        $book->update([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'author' => $authorModel ? $authorModel->name : $book->author,
        ]);

        if ($book->bookDetail) {
            $book->bookDetail->update(['description' => $validated['description'] ?? $book->bookDetail->description]);
        }

        return (new BookResource($book))->additional(['message' => 'បានកែប្រែតាម API ជោគជ័យ']);
    }

    public function destroy(string $id)
    {
        // ៥.៣ Module Protection (Role & Permission)
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'សុំទោស! មានតែ Admin ទេទើបអាចលុបសៀវភៅបាន!'], 403);
        }

        $book = Book::findOrFail($id);
        if ($book->cover_image)
            Storage::disk('public')->delete($book->cover_image);
        $book->delete();

        return response()->json(['message' => 'Admin បានលុបសៀវភៅចេញពី API រួចរាល់!'], 200);
    }

    // ==========================================
    // ផ្នែកទី ២៖ សម្រាប់ផ្ទាំង UI Web (Browser)
    // ==========================================

    public function uiIndex()
    {
        $books = Book::with(['category', 'detail'])->get();

        $booksCount = Book::count();
        $categoriesCount = \App\Models\Category::count();
        $authorsCount = \App\Models\Author::count();

        return view('books.index', compact('books', 'booksCount', 'categoriesCount', 'authorsCount'));
    }

    public function uiCreate()
    {
        $categories = \App\Models\Category::all();
        $authors = \App\Models\Author::all();
        return view('books.create', compact('categories', 'authors'));
    }

    public function uiStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpg,png|max:2048',
            'description' => 'nullable|string'  // បន្ថែមឱ្យគ្រប់គ្រាន់
        ]);

        $authorModel = Author::find($request->author_id);

        $book = Book::create([
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'author' => $authorModel ? $authorModel->name : 'Unknown Author',
        ]);

        if ($request->hasFile('cover_image')) {
            $book->cover_image = $request->file('cover_image')->store('books', 'public');
            $book->save();
        }

        BookDetail::create([
            'book_id' => $book->id,
            'description' => $request->description ?? 'មិនមានការពិពណ៌នា',
            'publisher' => 'រោងពុម្ពលំនាំដើម',
            'language' => 'Khmer',
            'page_count' => 0
        ]);

        return redirect()->route('books.ui')->with('success', 'បានបង្កើតសៀវភៅ និង Upload គម្របរួចរាល់!');
    }

    public function uiShow($id)
    {
        $book = Book::with(['category', 'detail'])->findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json($book);
        }

        return view('books.show', compact('book'));
    }

    public function uiEdit($id)
    {
        $book = Book::findOrFail($id);
        $categories = \App\Models\Category::all();
        $authors = \App\Models\Author::all();
        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function uiUpdate(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image)
                Storage::disk('public')->delete($book->cover_image);
            $book->cover_image = $request->file('cover_image')->store('books', 'public');
        }

        $authorModel = Author::find($request->author_id);
        $book->update([
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'author' => $authorModel ? $authorModel->name : $book->author,
        ]);

        if ($book->bookDetail) {
            $book->bookDetail->update(['description' => $request->description]);
        }

        return redirect()->route('books.ui')->with('success', 'បានកែប្រែព័ត៌មានជោគជ័យ!');
    }

    public function uiDestroy($id)
    {
        // UI Role Check Protect
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('books.ui')->with('error', 'អ្នកមិនមែនជា Admin ទេ មិនអាចលុបបានឡើយ!');
        }

        $book = Book::findOrFail($id);
        if ($book->cover_image)
            Storage::disk('public')->delete($book->cover_image);
        $book->delete();

        return redirect()->route('books.ui')->with('success', 'បានលុបសៀវភៅរួចរាល់!');
    }
}
