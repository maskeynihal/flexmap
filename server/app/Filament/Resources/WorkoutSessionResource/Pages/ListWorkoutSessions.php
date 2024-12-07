<?php

namespace App\Filament\Resources\WorkoutSessionResource\Pages;

use App\Filament\Resources\WorkoutSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkoutSessions extends ListRecords
{
    protected static string $resource = WorkoutSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
