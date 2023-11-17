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
        Schema::create('warnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false);
            $table->integer('issuer', false, true)->default(0); # 0 - automod, otherwise id of moderator who issued warning
            $table->string('reason')->nullable();
            $table->integer('days_left', false, true)->nullable(false)->default(30); # days remaining on the warning, defaults to 30
            $table->boolean('expired')->nullable(false)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warnings');
    }
};
