<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\G001M002Category;

class G001M002CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Novel, cerita dan karya fiksi lainnya'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku referensi dan non-fiksi'],
            ['name' => 'Anak', 'description' => 'Buku untuk anak-anak'],
            ['name' => 'Remaja', 'description' => 'Buku untuk remaja dan young adult'],
            ['name' => 'Agama', 'description' => 'Buku agama dan spiritual'],
        ];

        foreach ($categories as $c) {
            G001M002Category::updateOrCreate(['name' => $c['name']], $c);
        }
    }
}
