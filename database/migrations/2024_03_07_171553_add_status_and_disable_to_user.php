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
        Schema::table('users', function (Blueprint $table) {
            $table->string('visible_password')->after('password');
            $table->tinyInteger('status')->default(0)->comment('isLogin')->after('visible_password');
            $table->tinyInteger('disable')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('visible_password');
            $table->dropColumn('status');
            $table->dropColumn('disable');
        });
    }
};
