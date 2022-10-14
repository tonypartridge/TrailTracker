<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\EventsResource\Pages;
use App\Filament\Resources\EventsResource\RelationManagers;
use App\Models\Events;
use App\Models\Locations;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Str;
class EventsResource extends Resource
{
    protected static ?string $model = Events::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title'),
                TextInput::make('contact'),
                DateTimePicker::make('startDateTime'),
                DateTimePicker::make('endDateTime'),
                RichEditor::make('description')->columnSpan(2)->reactive(),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('Locations and Points'),
                        Forms\Components\Repeater::make('locations')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('location_id')
                                    ->label('Location')
                                    ->options(Locations::query()->pluck('name', 'id'))
                                    ->required()
                                    ->reactive()
                                    ->columnSpan([
                                        'md' => 8,
                                    ]),
                                Forms\Components\TextInput::make('points')
                                    ->numeric()
                                    ->mask(
                                        fn (Forms\Components\TextInput\Mask $mask) => $mask
                                            ->numeric()
                                            ->integer()
                                    )
                                    ->default(0)
                                    ->columnSpan([
                                        'md' => 2,
                                    ])
                                    ->required()
                            ])
                            ->dehydrated()
                            ->defaultItems(0)
                            ->disableLabel()
                            ->columns([
                                'md' => 10,
                            ])
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable(),
                TextColumn::make('contact')->sortable(),
                TextColumn::make('startDateTime')->sortable(),
                TextColumn::make('endDateTime')->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ManageEvents::route('/'),
        ];
    }
}
