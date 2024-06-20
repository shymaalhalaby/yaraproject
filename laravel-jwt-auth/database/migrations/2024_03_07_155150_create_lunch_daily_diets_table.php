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
        Schema::create('lunch_daily_diets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_diet_id')->constrained()->onDelete('cascade');
            $table->foreignId('lunch_id')->constrained()->onDelete('cascade');
            $table->string('amount');
            $table->string('snack2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lunch_daily_diets');
    }
};
