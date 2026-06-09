<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // ប្រើប្រាស់ Category::all()
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    // ប្រើប្រាស់ Category::create()
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json([
            'message' => 'បានបង្កើតប្រភេទសៀវភៅថ្មីជោគជ័យ!',
            'data' => $category
        ], 201);
    }

    // ប្រើប្រាស់ Category::find()
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'រកមិនឃើញទិន្នន័យឡើយ!'], 404);
        }
        return response()->json($category, 200);
    }

    // ប្រើប្រាស់ $category->update()
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'រកមិនឃើញទិន្នន័យដើម្បីកែប្រែឡើយ!'], 404);
        }

        $category->update($request->all());
        return response()->json([
            'message' => 'បានធ្វើបច្ចុប្បន្នភាពជោគជ័យ!',
            'data' => $category
        ], 200);
    }

    // ប្រើប្រាស់ Category::destroy()
    public function destroy(string $id)
    {
        $deleted = Category::destroy($id);
        if (!$deleted) {
            return response()->json(['message' => 'រកមិនឃើញទិន្នន័យដើម្បីលុបឡើយ!'], 404);
        }
        return response()->json(['message' => 'បានលុបចេញពីប្រព័ន្ធជោគជ័យ!'], 200);
    }

    public function apiIndex()
    {
        return response()->json(\App\Models\Category::all(), 200);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|unique:categories']);
        $category = \App\Models\Category::create($validated);
        return response()->json(['message' => 'បង្កើតប្រភេទជោគជ័យ!', 'category' => $category], 21);
    }

    public function uiCreate()
    {
        return view('categories.create');
    }

    // 🌟 ថែមមុខងារទទួលទិន្នន័យពី Form ទៅរក្សាទុកក្នុង Database
    public function uiStore(Request $request)
    {
        // Validation ទិន្នន័យ
        $request->validate([
            'name' => 'required|string|unique:categories,name',
        ], [
            'name.required' => 'សូមបញ្ចូលឈ្មោះប្រភេទសៀវភៅ!',
            'name.unique' => 'ឈ្មោះប្រភេទសៀវភៅនេះមានរួចហើយ!',
        ]);

        // រក្សាទុកក្នុង Database
        \App\Models\Category::create([
            'name' => $request->name
        ]);

        // នៅពេលបង្កើតរួច ឱ្យវាត្រឡប់ទៅកាន់ទំព័របង្កើតសៀវភៅវិញ ជាមួយនឹងសារជោគជ័យ
        return redirect()->route('books.ui')->with('success', 'បានបង្កើតប្រភេទសៀវភៅជោគជ័យ!');
    }
}
