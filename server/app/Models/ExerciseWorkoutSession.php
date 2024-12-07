<?php

namespace App\Models;

use App\Observers\ExerciseWorkoutSessionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ExerciseWorkoutSessionObserver::class)]
class ExerciseWorkoutSession extends Model
{
    use SoftDeletes;

    public $fillable = [
        'exercise_id',
        'workout_session_id',
        'user_id',
        'order_in_session',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function workoutSession()
    {
        return $this->belongsTo(WorkoutSession::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exerciseLogs()
    {
        return $this->hasMany(ExerciseLog::class);
    }
}
