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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->string('uri')->unique();
            $table->timestamp('start_at')->nullable();
            $table->integer('duration')->nullable();
            $table->tinyInteger('is_random')->default(0);
            $table->tinyInteger('is_notify')->default(0);
            $table->integer('nagative_point')->default(0);
            $table->string('certi_stamp')->nullable();
            $table->string('certi_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
