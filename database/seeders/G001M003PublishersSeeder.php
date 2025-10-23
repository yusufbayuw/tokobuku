<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\G001M003Publisher;

class G001M003PublishersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = [
            [
                'name' => 'Gramedia',
                'email' => 'info@gramedia.co.id',
                'phone' => '021-1234567',
                'address' => 'Jakarta, Indonesia',
                'description' => 'Large Indonesian publisher',
            ],
            [
                'name' => 'Mizan',
                'email' => 'contact@mizan.com',
                'phone' => '021-7654321',
                'address' => 'Bandung, Indonesia',
                'description' => 'Publisher focusing on religious and educational books',
            ],
            [
                'name' => 'Penerbit Kecil',
                'email' => 'hello@kecil.test',
                'phone' => null,
                'address' => null,
                'description' => 'Independent small publisher',
            ],
        ];

        foreach ($publishers as $p) {
            G001M003Publisher::updateOrCreate(['name' => $p['name']], $p);
        }
    }
}
