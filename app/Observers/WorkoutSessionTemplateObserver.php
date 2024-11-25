<?php

namespace App\Observers;

use App\Models\WorkoutSessionTemplate;
use Illuminate\Support\Facades\Auth;

class WorkoutSessionTemplateObserver
{
    /**
     * Handle the WorkoutSessionTemplate "creating" event.
     */
    public function creating(WorkoutSessionTemplate $workoutSessionTemplate): void
    {
        $workoutSessionTemplate->user_id = Auth::id();
    }
}
