<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\G001M004Book;
use App\Models\G002M007Location;
use App\Models\G002M008StockBalance;

class G002M008StockBalancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = G001M004Book::all();
        $locationId = G002M007Location::where('name', 'Toko')->first()->id;

        if ($books->isEmpty()) {
            return;
        }

        foreach ($books as $book) {
            G002M008StockBalance::updateOrCreate(
                ['g001_m004_book_id' => $book->id],
                [
                    'g001_m004_book_id' => $book->id,
                    'g002_m007_location_id' => $locationId,
                    'qty' => rand(1, 20),
                ]
            );
        }
    }
}
