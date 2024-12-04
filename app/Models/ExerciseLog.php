<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExerciseLog extends Model
{
    use SoftDeletes;

    public $fillable = [
        'workout_session_id',
        'exercise_group_identifier',
        'user_id',
        'exercise_id',
        'order_in_session',
        'sets',
        'reps',
        'weight',
        'weight_unit',
        'rest_time',
        'distance',
        'distance_unit',
        'duration',
        'note',
        'rest_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workoutSession()
    {
        return $this->belongsTo(WorkoutSession::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
