<?php

namespace App\Filament\Resources\TeamsResource\Pages;

use App\Filament\Resources\TeamsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTeams extends ManageRecords
{
    protected static string $resource = TeamsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
