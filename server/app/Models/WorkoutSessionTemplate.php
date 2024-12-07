<?php

namespace App\Models;

use App\Observers\WorkoutSessionTemplateObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(WorkoutSessionTemplateObserver::class)]
class WorkoutSessionTemplate extends Model
{
    use SoftDeletes;

    public $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exerciseWorkoutSessionTemplate()
    {
        return $this->hasMany(ExerciseWorkoutSessionTemplate::class, 'workout_session_template_id', 'id');
    }
}
