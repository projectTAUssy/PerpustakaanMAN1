<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create bookshelves
        DB::table('book_shelves')->insert([
            ['name' => 'Fiction'],
            ['name' => 'Non-Fiction'],
            ['name' => 'Science'],
            ['name' => 'History'],
            ['name' => 'Biography'],
        ]);

        // Create books
        DB::table('books')->insert([
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'publisher' => 'Scribner',
                'year_published' => 1925,
                'isbn' => '9780743273565',
                'quantity' => 10,
                'book_shelf_id' => 1, // Fiction
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'publisher' => 'J.B. Lippincott & Co.',
                'year_published' => 1960,
                'isbn' => '9780061120084',
                'quantity' => 8,
                'book_shelf_id' => 1, // Fiction
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'publisher' => 'Secker & Warburg',
                'year_published' => 1949,
                'isbn' => '9780451524935',
                'quantity' => 15,
                'book_shelf_id' => 1, // Fiction
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'publisher' => 'T. Egerton',
                'year_published' => 1813,
                'isbn' => '9781503290563',
                'quantity' => 12,
                'book_shelf_id' => 1, // Fiction
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'publisher' => 'Little, Brown and Company',
                'year_published' => 1951,
                'isbn' => '9780316769488',
                'quantity' => 7,
                'book_shelf_id' => 1, // Fiction
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
