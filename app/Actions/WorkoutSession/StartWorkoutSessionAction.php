<?php

namespace App\Actions\WorkoutSession;

use App\Models\WorkoutSession;
use App\Models\WorkoutSessionTemplate;

class StartWorkoutSessionAction
{
    /**
     * Start a new workout session.
     */
    public static function execute(array $data): WorkoutSession
    {
        $template = WorkoutSessionTemplate::findOrFail($data['workout_session_template_id']);

        $workoutSession = WorkoutSession::create([
            'workout_session_template_id' => $template->id,
            'name' => $template->name,
            'session_start_at' => now(),
        ]);
    }
}
