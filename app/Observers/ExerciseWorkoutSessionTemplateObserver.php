<?php

namespace App\Observers;

use App\Models\ExerciseWorkoutSessionTemplate;
use Illuminate\Support\Facades\Auth;

class ExerciseWorkoutSessionTemplateObserver
{
    /**
     * Handle the ExerciseWorkoutSessionTemplate "creating" event.
     */
    public function creating(ExerciseWorkoutSessionTemplate $exerciseWorkoutSessionTemplate): void
    {
        $exerciseWorkoutSessionTemplate->user_id = Auth::id();
    }
}
