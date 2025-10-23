<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\G001M004Book;
use App\Models\G001M001Author;

class G001M005AuthorBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = G001M004Book::all();
        $authors = G001M001Author::all();

        if ($books->isEmpty() || $authors->isEmpty()) {
            return;
        }

        foreach ($books as $book) {
            // ensure at least one author is attached
            if ($book->authors()->count() === 0) {
                $book->authors()->attach($authors->random()->id);
            }
        }
    }
}
