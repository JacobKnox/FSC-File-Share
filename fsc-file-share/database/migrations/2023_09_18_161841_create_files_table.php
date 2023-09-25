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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title', 1000);
            $table->string('description', 1000);
            $table->string('path', 1000);
            $table->string('tags', 1000)->nullable();
            $table->boolean('comments')->default(0);
            $table->boolean('likes')->default(0);
            $table->boolean('downloads')->default(0);
            $table->integer('count_likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
