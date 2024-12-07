<?php

namespace App\Observers;

use App\Models\ExerciseLog;
use Illuminate\Support\Facades\Auth;

class ExerciseLogObserver
{
    /**
     * Handle the ExerciseLog "creating" event.
     */
    public function creating(ExerciseLog $exerciseLog): void
    {
        $exerciseLog->user_id = Auth::id();
    }
}
