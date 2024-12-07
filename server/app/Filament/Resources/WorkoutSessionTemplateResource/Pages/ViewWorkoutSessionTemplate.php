<?php

namespace App\Filament\Resources\WorkoutSessionTemplateResource\Pages;

use App\Filament\Resources\WorkoutSessionTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkoutSessionTemplate extends ViewRecord
{
    protected static string $resource = WorkoutSessionTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
