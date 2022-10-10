<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecordsResource\Pages;
use App\Filament\Resources\RecordsResource\RelationManagers;
use App\Models\Events;
use App\Models\Locations;
use App\Models\Records;
use App\Models\Teams;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Filters\SelectFilter;

class RecordsResource extends Resource
{
    protected static ?string $model = Records::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_id')
                    ->label('Event')
                    ->options(Events::query()->pluck('title', 'id'))
                    ->required()
                    ->reactive()
                    ->columnSpan([
                        'md' => 8,
                    ]),
                Forms\Components\Select::make('team_id')
                    ->label('Team')
                    ->options(Teams::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->columnSpan([
                        'md' => 8,
                    ]),
                Forms\Components\Select::make('location_id')
                    ->label('Location')
                    ->options(Locations::query()->pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->columnSpan([
                        'md' => 8,
                    ]),
                Forms\Components\TextInput::make('points')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event.title')->sortable(),
                TextColumn::make('location.name')->sortable(),
                TextColumn::make('team.name')->sortable(),
                TextColumn::make('points')->sortable(),
            ])
            ->filters([
                SelectFilter::make('event')->relationship('event', 'title'),
                SelectFilter::make('team_id')->relationship('team', 'name'),
                SelectFilter::make('location_id')->relationship('location', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecords::route('/'),
            'create' => Pages\CreateRecords::route('/create'),
            'edit' => Pages\EditRecords::route('/{record}/edit'),
        ];
    }
}
