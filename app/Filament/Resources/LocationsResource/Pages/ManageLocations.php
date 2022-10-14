<?php

namespace App\Filament\Resources\LocationsResource\Pages;

use App\Filament\Resources\LocationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ManageLocations extends ManageRecords
{
    protected static string $resource = LocationsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Locaton'),
            ImportAction::make()
                ->fields([
                    ImportField::make('id')
                        ->label('ID')
                        ->helperText('This is the unique ID of the location, only enter if updating existing locations.'),

                    ImportField::make('name')
                        ->label('Location')
                        ->helperText('Name of the Location'),

                    ImportField::make('description')
                        ->label('Description')
                        ->helperText('Notes, info etc of the location'),

                    ImportField::make('lat')
                        ->label('Latitude')
                        ->helperText('Latitude of the location'),

                    ImportField::make('lon')
                        ->label('Longitude')
                        ->helperText('Longitude of the location'),

                ])
        ];
    }
}
