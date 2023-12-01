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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable(false);
            $table->string('roles')->nullable(false)->default(json_encode(["user"]));
            $table->string('name')->nullable(false);
            $table->integer('sid')->unique()->nullable(false);
            $table->string('username')->unique()->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pemail')->unique()->nullable();
            $table->timestamp('pemail_verified_at')->nullable();
            $table->string('password')->nullable(false);
            $table->boolean('visible')->nullable(false)->default(true);
            $table->boolean('verified')->nullable(false)->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
