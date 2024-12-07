<?php

namespace App\Filament\Resources\UserWeightResource\Pages;

use App\Filament\Resources\UserWeightResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserWeight extends ViewRecord
{
    protected static string $resource = UserWeightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
