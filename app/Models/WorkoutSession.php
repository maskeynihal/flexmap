<?php

namespace App\Models;

use App\Observers\WorkoutSessionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([WorkoutSessionObserver::class])]
class WorkoutSession extends Model
{
    use SoftDeletes;

    public $fillable = [
        'user_id',
        'workout_session_template_id',
        'name',
        'session_start_at',
        'session_end_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workoutSessionTemplate()
    {
        return $this->belongsTo(WorkoutSessionTemplate::class);
    }
}
