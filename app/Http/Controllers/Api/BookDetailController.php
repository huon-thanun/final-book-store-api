<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookDetail;
use Illuminate\Http\Request;

class BookDetailController extends Controller
{
    // API: បង្ហាញព័ត៌មានលម្អិតសៀវភៅ (មេរៀនទី ៥)
    public function show($book_id)
    {
        $detail = BookDetail::where('book_id', $book_id)->first();
        if (!$detail) {
            return response()->json(['message' => 'រកមិនឃើញព័ត៌មានលម្អិតឡើយ'], 404);
        }
        return response()->json($detail, 200);
    }

    // Web UI: បង្ហាញទំព័រកែប្រែព័ត៌មានលម្អិត (មេរៀនទី ៤)
    public function uiEdit($book_id)
    {
        $detail = BookDetail::where('book_id', $book_id)->firstOrFail();
        return view('books.edit_detail', compact('detail'));
    }

    // Web UI: រក្សាទុកការកែប្រែព័ត៌មានលម្អិត
    public function uiUpdate(Request $request, $id)
    {
        $detail = BookDetail::findOrFail($id);
        $request->validate([
            'publisher' => 'required|string',
            'language' => 'required|string',
            'page_count' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $detail->update($request->all());

        return redirect()->route('books.ui.show', $detail->book_id)->with('success', 'បានធ្វើបច្ចុប្បន្នភាពព័ត៌មានលម្អិតជោគជ័យ!');
    }
}