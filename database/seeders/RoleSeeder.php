<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Librarian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Member',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
