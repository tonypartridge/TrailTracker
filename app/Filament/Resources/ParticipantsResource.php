<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantsResource\Pages;
use App\Filament\Resources\ParticipantsResource\RelationManagers;
use App\Models\Teams;
use App\Models\Participants;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParticipantsResource extends Resource
{
    protected static ?string $model = Participants::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
//                Forms\Components\Select::make('team_id')
//                    ->label('Team')
//                    ->options(Teams::query()->pluck('name', 'id'))
//                    ->required()
//                    ->relationship('team', 'name')
//                    ->reactive()
//                    ->columnSpan(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
//                TextColumn::make('team.name')->sortable(),

            ])
            ->filters([
//                SelectFilter::make('team_id')->label('Team')->relationship('team', 'name')

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageParticipants::route('/'),
        ];
    }
}
