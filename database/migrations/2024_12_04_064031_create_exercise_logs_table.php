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
        Schema::create('exercise_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('workout_session_id')->nullable()->constrained();
            $table->foreignId('exercise_id')->constrained();

            $table->string('exercise_group_identifier');
            $table->unsignedTinyInteger('order_in_session');
            $table->unsignedTinyInteger('sets')->nullable();
            $table->unsignedTinyInteger('reps')->nullable();
            $table->unsignedTinyInteger('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->unsignedTinyInteger('rest_time')->nullable();
            $table->unsignedTinyInteger('distance')->nullable();
            $table->string('distance_unit')->nullable();
            $table->unsignedTinyInteger('duration')->nullable();
            $table->text('note')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_logs');
    }
};
