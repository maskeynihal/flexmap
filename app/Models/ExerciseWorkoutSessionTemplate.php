<?php

namespace App\Models;

use App\Observers\ExerciseWorkoutSessionTemplateObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ExerciseWorkoutSessionTemplateObserver::class)]
class ExerciseWorkoutSessionTemplate extends Model
{
    use SoftDeletes;

    public $table = 'exercise_workout_session_template';

    public $fillable = [
        'exercise_id',
        'workout_session_template_id',
        'user_id',
        'order_in_session',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function workoutSessionTemplate()
    {
        return $this->belongsTo(WorkoutSessionTemplate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
