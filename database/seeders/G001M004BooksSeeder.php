<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\G001M004Book;
use App\Models\G001M001Author;
use App\Models\G001M002Category;
use App\Models\G001M003Publisher;

class G001M004BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch some existing authors, categories, and publishers
        $authors = G001M001Author::all();
        $categories = G001M002Category::all();
        $publishers = G001M003Publisher::all();

        if ($publishers->isEmpty() || $authors->isEmpty() || $categories->isEmpty()) {
            // If prerequisites are missing, skip
            return;
        }

        $books = [
            [
                'title' => 'Murder on the Orient Express',
                'subtitle' => null,
                'isbn' => '9780007119318',
                'sku' => 'BK-AGR-0001',
                'g001_m003_publisher_id' => $publishers->first()->id,
                'edition' => '1',
                'year' => 1934,
                'language' => 'English',
                'pages' => 256,
                'cover_photo' => null,
                'retail_price' => 120000,
                'agent_price' => 100000,
                'min_stock' => 1,
                'active' => true,
            ],
            [
                'title' => 'Bumi Manusia',
                'subtitle' => null,
                'isbn' => '9789794213833',
                'sku' => 'BK-PRA-0001',
                'g001_m003_publisher_id' => $publishers->skip(1)->first()->id ?? $publishers->first()->id,
                'edition' => '1',
                'year' => 1980,
                'language' => 'Indonesian',
                'pages' => 452,
                'cover_photo' => null,
                'retail_price' => 90000,
                'agent_price' => 80000,
                'min_stock' => 2,
                'active' => true,
            ],
        ];

        foreach ($books as $b) {
            $book = G001M004Book::updateOrCreate(
                ['title' => $b['title']],
                $b
            );

            // attach random authors (from existing seeded authors)
            $attachAuthors = $authors->random(min(2, $authors->count()))->pluck('id')->toArray();
            $book->authors()->sync($attachAuthors);

            // attach random categories
            $attachCategories = $categories->random(min(2, $categories->count()))->pluck('id')->toArray();
            $book->categories()->sync($attachCategories);
        }
    }
}
