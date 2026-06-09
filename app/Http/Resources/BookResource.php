<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'cover_image' => $this->cover_image ? asset('storage/' . $this->cover_image) : null,
            'category_id' => $this->category_id,
            'category_name' => $this->category ? $this->category->name : null,
            // 🌟 បន្ថែមត្រង់នេះដើម្បីបង្ហាញទៅកាន់ Postman
            'author_id' => $this->author_id,
            'author_name' => $this->authorRelation ? $this->authorRelation->name : $this->author,
            'description' => $this->detail ? $this->detail->description : null,
            'created_at' => $this->created_at,
        ];
    }
}
