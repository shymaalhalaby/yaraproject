<?php

use App\Models\coach;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('ProfileImage')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->bigInteger('phone_number');
            $table->integer('Age');
            $table->text('illness')->nullable();
            $table->text('GOAL')->nullable();
            $table->text('Physical_case')->nullable();
            $table->double('Hieght');
            $table->double('Wieght');
            $table->double('target_Wieght');
            $table->string('AT');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete;
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
