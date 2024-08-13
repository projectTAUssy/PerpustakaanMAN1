<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Truncate all tables
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('members')->truncate();
        DB::table('books')->truncate();
        DB::table('book_shelves')->truncate();
        // Add other tables as needed

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();

        // Call individual seeders
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            BookSeeder::class,
            // Add other seeders as needed
        ]);
    }
}