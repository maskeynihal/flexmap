<?php

namespace App\Filament\Resources\UserWeightResource\Pages;

use App\Filament\Resources\UserWeightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserWeights extends ListRecords
{
    protected static string $resource = UserWeightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
