<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamsResource\Pages;
use App\Filament\Resources\TeamsResource\RelationManagers;
use App\Models\Participants;
use App\Models\Teams;
use App\Models\Events;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class TeamsResource extends Resource
{
    protected static ?string $model = Teams::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->required()->columnSpan(1),
                Forms\Components\Select::make('event_id')
                    ->label('Event')
                    ->options(Events::query()->pluck('title', 'id'))
                    ->required()
                    ->relationship('event', 'title')
                    ->reactive()
                    ->columnSpan(1),
                RichEditor::make('description')->columnSpan(2)->reactive(),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('Participants'),
                        Forms\Components\Repeater::make('participants')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('participant_id')
                                    ->label('Participant')
                                    ->options(Participants::query()->pluck('name', 'id'))
                                    ->required()
                                    ->reactive()
                                    ->columnSpan([
                                        'md' => 8,
                                    ]),
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
                TextColumn::make('name')->sortable(),
                TextColumn::make('event.title')->sortable(),
            ])
            ->filters([
                SelectFilter::make('event_id')->label('Event')->relationship('event', 'title')
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
            'index' => Pages\ManageTeams::route('/'),
        ];
    }
}
