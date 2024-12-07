<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Models\Exercise;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                Textarea::make('description')
                    ->required(),

                Select::make('type')
                    ->options(collect(Exercise::EXERCISE_TYPES)->mapWithKeys(fn (array $item) => [$item['value'] => $item['label']]))
                    ->searchable()
                    ->required(),

                Select::make('equipment')
                    ->options(collect(Exercise::EQUIPMENTS)->mapWithKeys(fn (array $item) => [$item['value'] => $item['label']]))
                    ->searchable()
                    ->required(),

                TextInput::make('main_target')
                    ->required(),

                TagsInput::make('targets')
                    ->required()
                    ->label('Targets')
                    ->placeholder('Add targets'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->formatStateUsing(fn (string $state) => Exercise::EXERCISE_TYPES[$state]['label'])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('equipment')
                    ->formatStateUsing(fn (string $state) => Exercise::EQUIPMENTS[$state]['label'])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('main_target')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(collect(Exercise::EXERCISE_TYPES)->mapWithKeys(fn (array $item) => [$item['value'] => $item['label']]))
                    ->label('Type')
                    ->multiple(),

                SelectFilter::make('equipment')
                    ->options(collect(Exercise::EQUIPMENTS)->mapWithKeys(fn (array $item) => [$item['value'] => $item['label']]))
                    ->label('Equipment')
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListExercises::route('/'),
            'create' => Pages\CreateExercise::route('/create'),
            'view' => Pages\ViewExercise::route('/{record}'),
            'edit' => Pages\EditExercise::route('/{record}/edit'),
        ];
    }
}
