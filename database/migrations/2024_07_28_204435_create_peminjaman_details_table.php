<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('peminjaman_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade'); // Ubah 'books' menjadi 'bukus'
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman_details');
    }
}
