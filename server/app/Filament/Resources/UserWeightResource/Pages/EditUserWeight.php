<?php

namespace App\Filament\Resources\UserWeightResource\Pages;

use App\Filament\Resources\UserWeightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserWeight extends EditRecord
{
    protected static string $resource = UserWeightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
