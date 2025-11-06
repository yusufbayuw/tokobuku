<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('12345678'),
            'username' => 'superadmin',
            'role_helper' => 'super_admin'
        ]);
        
        $admin = User::create([
            'name' => 'Lorem Ipsum',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'username' => 'admin',
            'role_helper' => 'admin'
        ]);

        $agen1 = User::create([
            'name' => 'Dolor Amet',
            'email' => 'agen@agen.com',
            'password' => bcrypt('12345678'),
             'username' => 'agen',
            'role_helper' => 'agen'
        ]);
    }
}
