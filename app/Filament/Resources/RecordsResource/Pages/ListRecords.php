<?php

namespace App\Filament\Resources\RecordsResource\Pages;

use App\Filament\Resources\RecordsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords as PageListRecords;

class ListRecords extends PageListRecords
{
    protected static string $resource = RecordsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
