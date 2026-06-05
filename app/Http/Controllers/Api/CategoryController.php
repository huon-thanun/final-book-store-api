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
}
