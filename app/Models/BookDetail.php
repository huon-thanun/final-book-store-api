<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    use HasFactory;

    // 🌟 ចំណុចសំខាន់៖ ត្រូវបន្ថែម fields ទាំងនេះដើម្បីអនុញ្ញាតឱ្យ Controller បញ្ចូលទិន្នន័យបាន
    protected $fillable = [
        'book_id',
        'description',
        'publisher',
        'language',
        'page_count'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
