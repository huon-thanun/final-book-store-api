<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     * index(): ប្រើ Book::all()
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     * store(): ប្រើ Book::create($request->all())
     */
    public function store(Request $request)
    {
        // បង្កើតទិន្នន័យសៀវភៅថ្មីចូលទៅក្នុង Database
        $book = Book::create($request->all());

        return response()->json([
            'message' => 'ជោគជ័យ',
            'data' => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     * show(): ប្រើ Book::find($id)
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'រកមិនឃើញសៀវភៅឡើយ'], 404);
        }

        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     * update(): ប្រើ $book->update($request->all())
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'រកមិនឃើញសៀវភៅដើម្បីកែប្រែឡើយ'], 404);
        }

        // ធ្វើបច្ចុប្បន្នភាពទិន្នន័យ
        $book->update($request->all());

        return response()->json([
            'message' => 'បានកែប្រែដោយជោគជ័យ',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * destroy(): ប្រើ Book::destroy($id)
     */
    public function destroy(string $id)
    {
        $deleted = Book::destroy($id);

        if (!$deleted) {
            return response()->json(['message' => 'រកមិនឃើញសៀវភៅដើម្បីលុបឡើយ'], 404);
        }

        return response()->json([
            'message' => "បានលុបសៀវភៅ ID: $id ចេញពីប្រព័ន្ធ"
        ]);
    }

    public function uiIndex()
    {
        // ទាញទិន្នន័យសៀវភៅទាំងអស់មកបង្ហាញ
        $books = Book::with(['author', 'category', 'bookDetail'])->orderBy('id', 'desc')->get();
        return view('books.index', compact('books'));
    }

    /**
     * UI Create: បង្ហាញ Form បង្កើតសៀវភៅថ្មី
     */
    public function uiCreate()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('books.create', compact('categories', 'authors'));
    }

    /**
     * UI Store: រក្សាទុកសៀវភៅ និង Upload រូបភាព (យោងតាមប្រអប់មេរៀនជំហានទី៣.១)
     */
    public function uiStore(Request $request)
    {
        // ផ្នែកខាងលើ៖ បន្ថែមលក្ខខណ្ឌ Validation លើរូបភាព
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpg,png|max:2048',  // 👈 លក្ខខណ្ឌមេរៀនប្រអប់ទី១
            'description' => 'nullable|string',
        ]);

        $authorModel = Author::find($validated['author_id']);

        // បង្កើត Object សៀវភៅថ្មី ប៉ុន្តែកុំទាន់អាល Save ទៅក្នុង Database ភ្លាមៗដើម្បីរៀបចំរឿងរូបភាព
        $book = new Book([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'author' => $authorModel ? $authorModel->name : 'Unknown Author',
        ]);

        // ផ្នែកមុននឹងបញ្ជា $book->save();
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // រក្សាទុកក្នុង Folder storage/app/public/books
            $book->cover_image = $file->storeAs('books', $filename, 'public');
        }

        $book->save();

        // បង្កើតទិន្នន័យលម្អិតចូលក្នុងតារាង book_details
        BookDetail::create([
            'book_id' => $book->id,
            'description' => $request->input('description') ?? 'មិនមានការពិពណ៌នា',
            'publisher' => 'រោងពុម្ពលំនាំដើម',
            'language' => 'Khmer',
            'page_count' => 0
        ]);

        return redirect()->route('books.ui')->with('success', 'សៀវភៅថ្មីត្រូវបានបង្កើត និង Upload គម្របរួចរាល់!');
    }

    /**
     * UI Show: បង្ហាញព័ត៌មានលម្អិតសៀវភៅ (Detail)
     * មុខងារនេះត្រូវបានហៅឡើងនៅពេលចុចប៊ូតុងមើលលម្អិត (រូបភ្នែក)
     */
    public function uiShow($id)
    {
        // ស្វែងរកទិន្នន័យសៀវភៅ រួមទាំងទាញយកទិន្នន័យពី Table ដែលទាក់ទង (Author, Category, BookDetail)
        $book = Book::with(['author', 'category', 'bookDetail'])->findOrFail($id);

        // បញ្ជូនទិន្នន័យទៅកាន់ផ្ទាំង View ឈ្មោះ show.blade.php
        return view('books.show', compact('book'));
    }

    /**
     * UI Edit: បង្ហាញ Form កែប្រែ
     */
    public function uiEdit($id)
    {
        $book = Book::with('bookDetail')->findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();
        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    /**
     * UI Update: កែប្រែទិន្នន័យ និងផ្លាស់ប្តូររូបភាព (យោងតាមប្រអប់មេរៀនជំហានទី៣.២)
     */
    public function uiUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $authorModel = Author::find($validated['author_id']);

        // កូដគ្រប់គ្រងការ Upload ពេល Update
        if ($request->hasFile('cover_image')) {
            // ក. ពិនិត្យមើលបើមានរូបចាស់ ត្រូវលុបចេញពី Server ជាមុនសិន
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }

            // ខ. រក្សាទុករូបថ្មីជំនួសវិញ
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $book->cover_image = $file->storeAs('books', $filename, 'public');
        }

        $book->update([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'cover_image' => $book->cover_image,  // រក្សារូបភាពបច្ចុប្បន្ន
            'author' => $authorModel ? $authorModel->name : 'Unknown Author',
        ]);

        if ($book->bookDetail) {
            $book->bookDetail->update([
                'description' => $request->input('description') ?? 'មិនមានការពិពណ៌នា',
            ]);
        }

        return redirect()->route('books.ui')->with('success', 'បានធ្វើបច្ចុប្បន្នភាពព័ត៌មាន និងរូបភាពគម្របរួចរាល់!');
    }

    /**
     * UI Destroy: លុបទិន្នន័យ និងលុបរូបភាពពី Server (យោងតាមប្រអប់មេរៀនជំហានទី៣.៣)
     */
    public function uiDestroy($id)
    {
        $book = Book::findOrFail($id);

        // មុននឹងបញ្ជា $book->delete(); ត្រូវលុបរូបចេញពី Server សិន
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        // លុបព័ត៌មានលម្អិត និងលុបសៀវភៅចេញពី Database
        if ($book->bookDetail) {
            $book->bookDetail->delete();
        }
        $book->delete();

        return redirect()->route('books.ui')->with('success', 'បានលុបទិន្នន័យសៀវភៅ និងរូបភាពគម្របចេញពី Server រួចរាល់!');
    }
}
