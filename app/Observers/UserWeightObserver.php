<?php

namespace App\Observers;

use App\Models\UserWeight;
use Illuminate\Support\Facades\Auth;

class UserWeightObserver
{
    /**
     * Handle the UserWeight "updating" event.
     */
    public function creating(UserWeight $userWeight): void
    {
        $userWeight->user_id = Auth::id();

    }
}
