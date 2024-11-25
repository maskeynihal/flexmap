<?php

namespace App\Filament\Resources\WorkoutSessionTemplateResource\Pages;

use App\Filament\Resources\WorkoutSessionTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkoutSessionTemplate extends EditRecord
{
    protected static string $resource = WorkoutSessionTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
