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
        Schema::create('bugs', function (Blueprint $table) {
            $table->id();
            $table->integer('reporter')->nullable(false)->default(-1); # -1 - guest
            $table->string('category')->nullable(false)->default('Other');
            $table->string('intended')->nullable(false);
            $table->string('actual')->nullable(false);
            $table->string('other')->nullable();
            $table->string('page')->nullable(false);
            $table->boolean('resolved')->nullable(false)->default(false);
            $table->boolean('pushed')->nullable(false)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bugs');
    }
};
