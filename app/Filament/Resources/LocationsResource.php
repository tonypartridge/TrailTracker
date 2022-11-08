<?php

namespace App\Filament\Resources;

use Str;
use Filament\Tables;
use App\Models\Locations;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Humaidem\FilamentMapPicker\Fields\OSMMap;
use App\Filament\Resources\LocationsResource\Pages;
use App\Filament\Resources\LocationsResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class LocationsResource extends Resource
{
    protected static ?string $model = Locations::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('address'),
                TextInput::make('lat'),
                TextInput::make('lon'),
                RichEditor::make('description')->columnSpan(2),
//                OSMMap::make('location')
//                    ->columnSpan(2)
//                    ->label('Pick Location')
//                    ->showMarker()
//                    ->draggable()
//                    ->extraControl([
//                        'zoomControl'           => true,
//                        'zoom'                  => 12,
//                        'maxZoom'               => 17,
//                        'zoomSnap'              => 0.50,
//                        'wheelPxPerZoomLevel'   => 1,
//                    ])
//                    // tiles url (refer to https://www.spatialbias.com/2018/02/qgis-3.0-xyz-tile-layers/)
//                    ->tilesUrl('https://tile.opentopomap.org/{z}/{x}/{y}.png')
//                    ->afterStateHydrated(function ($state, callable $set, $get) {
//
//                        $latLng = !is_array($state) ? json_decode($state) : (object) $state;
//
//                        if ($latLng) {
//                            /** @var Point $state */
//                            $set('location', ['lat' => $latLng->lat, 'lng' => $latLng->lng]);
//                            $set('lat', $latLng->lat);
//                            $set('lon', $latLng->lng);
//                        } else {
//                            // Fetch from lat/lng
//                            $set('location', ['lat' => $get('lat'), 'lng' => $get('lon')]);
//                        }
//                    })
//                    ->afterStateUpdated(function ($state, callable $set) {
//                        if ($state) {
//                            /** @var Point $state */
//                            $set('lat', $state['lat']);
//                            $set('lon', $state['lng']);
//                        }
//                    })

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('lat')->sortable(),
                TextColumn::make('lon')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('qrcode')
                    ->action(fn () => '')
                    ->modalContent(
                        fn ($record) => view('filament.components.qrcode', ['record' => $record])
                    )
                    ->modalHeading('Location QR Code')
                    ->modalButton('Close', ''),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export')
                    ->defaultFormat('csv')
                    ->fileName(Str::of(config('app.name', 'TrailTracker'))->slug('_locations_') . '_' . date('d_m_Y_H_i_s'))
            ])->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->defaultFormat('csv')
                    ->fileName(Str::of(config('app.name', 'TrailTracker'))->slug('_locations_') . '_' . date('d_m_Y_H_i_s'))
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLocations::route('/'),
        ];
    }

}
