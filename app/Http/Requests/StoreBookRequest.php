<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;  // ប្តូរទៅជា true ដើម្បីអនុញ្ញាតឱ្យប្រើប្រាស់
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',  // ត្រូវតែមាន និងមានពិតប្រាកដក្នុងតារាង categories
            'author_id' => 'required|exists:authors,id',  // ត្រូវតែមាន និងមានពិតប្រាកដក្នុងតារាង authors
            'title' => 'required|string|max:255',  // មិនអាចទទេ ជាអក្សរ និងមិនលើសពី ២៥៥ ខ្ទង់
            'price' => 'required|numeric|min:0',  // មិនអាចទទេ ជាលេខ និងចាប់ពី ០ ឡើងទៅ
            'description' => 'nullable|string',  // អាចទទេបាន ប៉ុន្តែបើមានត្រូវតែជាអក្សរ
        ];
    }
}
