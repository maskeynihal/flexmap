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

        $exerciseWorkoutSessions = $workoutSession->exerciseWorkoutSession()->createMany(
            collect($data['exercises'])->map(function ($exercise_id, $index) {
                return [
                    'exercise_id' => $exercise_id,
                    'order_in_session' => $index + 1,
                ];
            })
        );

        foreach ($exerciseWorkoutSessions as $exerciseWorkoutSession) {
            $exerciseWorkoutSession->exerciseLogs()->create([
                'order_in_session' => 1,
                'exercise_id' => $exerciseWorkoutSession->exercise_id,
            ]);
        }

        return $workoutSession;
    }
}
