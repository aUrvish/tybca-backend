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
        Schema::create('quiz_inputs', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->integer('quiz_id');
            $table->string('name');
            $table->tinyInteger('is_answer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_inputs');
    }
};
