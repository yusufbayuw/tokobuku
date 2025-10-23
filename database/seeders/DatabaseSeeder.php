<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            LocationSeeder::class,
            UserSeeder::class,
            G001M001AuthorsSeeder::class,
            G001M002CategoriesSeeder::class,
            G001M003PublishersSeeder::class,
            G001M004BooksSeeder::class,
            G001M005AuthorBooksSeeder::class,
            G001M006CategoryBooksSeeder::class,
            G002M008StockBalancesSeeder::class,
        ]);
    }
}
