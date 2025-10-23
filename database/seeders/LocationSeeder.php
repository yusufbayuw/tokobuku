<?php

namespace Database\Seeders;

use App\Models\G002M007Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        G002M007Location::firstOrCreate([
            'name' => 'Toko',
            'type' => 'toko',
        ]);
    }
}
