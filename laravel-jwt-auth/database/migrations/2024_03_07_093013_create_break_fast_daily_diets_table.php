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
        Schema::create('break_fast_daily_diets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_diet_id')->constrained()->onDelete('cascade');
            $table->foreignId('break_fast_id')->constrained()->onDelete('cascade');
            $table->string('amount');
            $table->string('snack1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('break_fast_daily_diets');
    }
};
