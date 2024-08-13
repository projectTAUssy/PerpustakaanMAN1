<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1, // Assuming 1 is the ID for Admin role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Librarian User',
                'email' => 'librarian@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // Assuming 2 is the ID for Librarian role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Member User',
                'email' => 'member@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // Assuming 3 is the ID for Member role
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

       
    }
}
