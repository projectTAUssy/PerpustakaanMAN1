<?php
// database/migrations/xxxx_xx_xx_create_visits_table.php

// database/migrations/xxxx_xx_xx_create_visits_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('visited_at')->useCurrent();
            $table->timestamps();
            
            $table->unique(['user_id', 'visited_at']); // Ensure unique visit per day per user
        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
