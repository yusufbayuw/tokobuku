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
        ]);
        $superadmin->assignRole('super_admin');
        $superadmin->save();
        
        $admin = User::create([
            'name' => 'Lorem Ipsum',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'username' => 'admin',
        ]);
        $admin->assignRole('admin');
        $admin->save();

        $agen1 = User::create([
            'name' => 'Dolor Amet',
            'email' => 'agen@agen.com',
            'password' => bcrypt('12345678'),
        ]);
        $agen1->assignRole('agen');
        $agen1->username = 'agen';
        $agen1->save();
    }
}
