<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
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
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use App\Models\User;
use Stevebauman\Purify\Facades\Purify;
use Str;

class ParticipantsResource extends Resource
{
    protected static ?string $model = Participants::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email'),
                DatePicker::make('dob')
                    ->placeholder('06-06-1980')
//                    ->minDate(date('d-m-Y', strtotime('now -13 years')))
                    ->default('06-06-1980'),
                TextInput::make('emergency_name'),
                TextInput::make('emergency_phone'),
                TextInput::make('emergency_relation'),
                Select::make('user_id')
                    ->label('Linked to User')
                    ->allowHtml() // Apply the new modifier to enable HTML in the options - it's disabled by default
                    ->searchable() // Don't forget to make it searchable otherwise there is no choices.js magic!
                    ->getSearchResultsUsing(function (string $search) {
                        $users = User::where('name', 'like', "%{$search}%")->limit(50)->get();
                        return $users->mapWithKeys(function ($user) {
                            return [$user->getKey() => static::getCleanOptionString($user)];
                        })->toArray();
                    })
                    ->getOptionLabelUsing(function ($value): string {
                        $user = User::find($value);

                        return static::getCleanOptionString($user);
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('email')->sortable(),
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
            'index' => Pages\ManageParticipants::route('/'),
        ];
    }

    public static function getCleanOptionString(\App\Models\User $model): string
    {
        return Purify::clean(
            view('filament.components.select-user-result')
                ->with('name', $model?->name)
                ->with('email', $model?->email)
                ->with('image', $model?->image)
                ->render()
        );
    }
}
