<?php

namespace App\Observers;

use App\Models\WorkoutSession;
use Illuminate\Support\Facades\Auth;

class WorkoutSessionObserver
{
    /**
     * Handle the WorkoutSessionTemplate "creating" event.
     */
    public function creating(WorkoutSession $workoutSession): void
    {
        $workoutSession->user_id = Auth::id();
    }
}
