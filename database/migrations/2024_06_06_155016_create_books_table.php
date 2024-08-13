<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('author', 100)->nullable();
            $table->string('publisher', 100)->nullable();
            $table->year('year_published')->nullable();
            $table->string('isbn', 13)->unique()->nullable();
            $table->string('cover')->nullable();
            $table->integer('quantity');
            $table->foreignId('book_shelf_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
