<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'total_books' => $this->collection->count(),
                'store_name' => 'ហាងលក់សៀវភៅ (Book Store API)',
                'api_version' => '1.0'
            ]
        ];
    }
}