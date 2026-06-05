<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookDetail;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ១. បង្កើតទិន្នន័យមេ (Master Data)៖ អ្នកនិពន្ធ ៥ នាក់ និង ប្រភេទសៀវភៅ ៥
        $authors = Author::factory()->count(5)->create();  //
        $categories = Category::factory()->count(5)->create();  //

        // ២. បង្កើតរង្វិលជុំ (Loop) ចំនួន ២០ ដង ដើម្បីបង្កើតសៀវភៅ ២០ ក្បាល
        for ($i = 0; $i < 20; $i++) {
            // ៣. បង្កើតសៀវភៅ ដោយទាញយក ID ដោយចៃដន្យពី $authors និង $categories
            $book = Book::factory()->create([
                'author_id' => $authors->random()->id,  // គន្លឹះ៖ ->random()->id
                'category_id' => $categories->random()->id,  // គន្លឹះ៖ ->random()->id
            ]);  //

            // ៤. បង្កើតព័ត៌មានលម្អិតសៀវភៅ ដោយភ្ជាប់ទៅកាន់ $book ដែលទើបបង្កើតខាងលើ
            BookDetail::factory()->create([
                'book_id' => $book->id  // យក ID ពីសៀវភៅខាងលើមកបំពេញ
            ]);  //
        }
    }
}
