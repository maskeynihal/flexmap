<?php

namespace App\Filament\Resources\WorkoutSessionTemplateResource\Pages;

use App\Filament\Resources\WorkoutSessionTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkoutSessionTemplates extends ListRecords
{
    protected static string $resource = WorkoutSessionTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
