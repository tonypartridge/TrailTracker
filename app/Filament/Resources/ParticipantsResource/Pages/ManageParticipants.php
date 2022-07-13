<?php

namespace App\Filament\Resources\ParticipantsResource\Pages;

use App\Filament\Resources\ParticipantsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageParticipants extends ManageRecords
{
    protected static string $resource = ParticipantsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
