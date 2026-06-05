<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // កំណត់ Fields ដែលអនុញ្ញាតឱ្យបញ្ចូលទិន្នន័យបាន
    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'cover_image',
        'author',
        'price'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookDetail()
    {
        return $this->hasOne(BookDetail::class);  // One-to-One
    }
}
