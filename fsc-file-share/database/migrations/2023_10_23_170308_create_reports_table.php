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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('reporter')->nullable(false)->default(0); # 0 - auto moderator, -1 - guest
            $table->integer('type')->nullable(false); # 0 - user, 1 - file, 2 - comment
            $table->integer('reported')->nullable(false); # ID of the user or file being reported
            $table->string('category')->nullable(false)->default('Other');
            $table->string('info')->nullable();
            $table->boolean('resolved')->nullable(false)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
