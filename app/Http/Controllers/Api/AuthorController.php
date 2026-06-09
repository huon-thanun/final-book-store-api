<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uiCreate()
    {
        return view('authors.create');
    }

    public function uiStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'bio' => 'nullable|string',
            'email' => 'required|email|unique:authors,email'  // បន្ថែម validation ឱ្យត្រូវនឹង database
        ]);

        \App\Models\Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'email' => $request->email
        ]);

        return redirect()->route('books.ui')->with('success', 'បានបន្ថែមអ្នកនិពន្ធជោគជ័យ!');
    }
}
