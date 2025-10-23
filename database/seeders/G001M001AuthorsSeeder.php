<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\G001M001Author;
use Illuminate\Support\Str;

class G001M001AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Agatha Christie',
                'bio' => 'Agatha Christie was an English writer known for her 66 detective novels and 14 short story collections.',
                'photo' => null,
            ],
            [
                'name' => 'Pramoedya Ananta Toer',
                'bio' => 'Indonesian author known for the Buru Quartet and other works.',
                'photo' => null,
            ],
            [
                'name' => 'J.K. Rowling',
                'bio' => 'British author, best known for the Harry Potter series.',
                'photo' => null,
            ],
            [
                'name' => 'Tere Liye',
                'bio' => 'Popular Indonesian author known for contemporary young adult novels.',
                'photo' => null,
            ],
        ];

        foreach ($authors as $a) {
            G001M001Author::updateOrCreate(
                ['name' => $a['name']],
                $a
            );
        }
    }
}
