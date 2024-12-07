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
        Schema::create('exercise_workout_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exercise_id')->constrained();
            $table->foreignId('workout_session_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unsignedTinyInteger('order_in_session')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_workout_sessions');
    }
};
