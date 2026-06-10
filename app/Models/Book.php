<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'stock',
        'category_id',
        'author_id',
        'author',
        'cover_image'
    ];

    // 🌟 បង្កើត Relationship ឱ្យត្រូវគ្នានឹងកូដដែលអ្នកហៅក្នុង Controller ($book->with(['authorRelation']))
    public function authorRelation()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detail()
    {
        return $this->hasOne(BookDetail::class);
    }

    public function bookDetail()
    {
        return $this->hasOne(BookDetail::class, 'book_id');
    }
}
