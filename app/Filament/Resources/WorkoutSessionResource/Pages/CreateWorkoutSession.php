<?php

namespace App\Filament\Resources\WorkoutSessionResource\Pages;

use App\Actions\WorkoutSession\StartWorkoutSessionAction;
use App\Filament\Resources\WorkoutSessionResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateWorkoutSession extends CreateRecord
{
    protected static string $resource = WorkoutSessionResource::class;

    protected static bool $canCreateAnother = false;

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getCancelFormAction(),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        return StartWorkoutSessionAction::execute($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Workout Session Started';
    }
}
