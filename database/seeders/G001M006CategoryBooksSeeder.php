<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\G001M004Book;
use App\Models\G001M002Category;

class G001M006CategoryBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = G001M004Book::all();
        $categories = G001M002Category::all();

        if ($books->isEmpty() || $categories->isEmpty()) {
            return;
        }

        foreach ($books as $book) {
            if ($book->categories()->count() === 0) {
                $book->categories()->attach($categories->random()->id);
            }
        }
    }
}
