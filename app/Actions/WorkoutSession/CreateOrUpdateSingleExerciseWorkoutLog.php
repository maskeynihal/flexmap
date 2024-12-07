<?php

namespace App\Actions\WorkoutSession;

use App\Models\ExerciseWorkoutSession;

class CreateOrUpdateSingleExerciseWorkoutLog
{
    public function __construct()
    {
        // Constructor code here
    }

    public static function execute(ExerciseWorkoutSession $workoutSession, array $data)
    {
        $exerciseLog = $workoutSession->exerciseLogs()->updateOrCreate(
            ['id' => $data['id']],
            $data
        );

        return $exerciseLog;
    }
}
