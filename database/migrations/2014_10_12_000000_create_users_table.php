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
            $table->id()->from(214100);
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->integer('role_id')->default(2);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('city');
            $table->string('country');
            $table->string('password');
            $table->tinyInteger('is_deleted')->default(0);
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
