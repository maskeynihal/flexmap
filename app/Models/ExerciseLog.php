<?php

namespace App\Models;

use App\Observers\ExerciseLogObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ExerciseLogObserver::class)]
class ExerciseLog extends Model
{
    use SoftDeletes;

    public $fillable = [
        'exercise_workout_session_id',
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

    public function exerciseWorkoutSession()
    {
        return $this->belongsTo(ExerciseWorkoutSession::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
