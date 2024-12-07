<?php

namespace App\Observers;

use App\Models\ExerciseWorkoutSession;
use Illuminate\Support\Facades\Auth;

class ExerciseWorkoutSessionObserver
{
    /**
     * Handle the ExerciseWorkoutSession "creating" event.
     */
    public function creating(ExerciseWorkoutSession $exerciseWorkoutSession): void
    {
        $exerciseWorkoutSession->user_id = Auth::id();
    }
}
