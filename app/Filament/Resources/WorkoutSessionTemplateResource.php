<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkoutSessionTemplateResource\Pages;
use App\Models\WorkoutSessionTemplate;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WorkoutSessionTemplateResource extends Resource
{
    protected static ?string $model = WorkoutSessionTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Workout Session')
                    ->schema([
                        TextInput::make('name')
                            ->required(),

                        Textarea::make('description'),
                        Repeater::make('exerciseWorkoutSessionTemplate')
                            ->simple(
                                Select::make('exercise_id')
                                    ->label('Exercise')
                                    ->options(fn () => \App\Models\Exercise::select('id', 'name')->get()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->searchPrompt('Search exercise by it\'s name or category')
                            )
                            ->relationship()
                            ->orderColumn('order_in_session'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exercise_workout_session_template_count')
                    ->counts('exerciseWorkoutSessionTemplate')
                    ->label('Total Exercises')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListWorkoutSessionTemplates::route('/'),
            'create' => Pages\CreateWorkoutSessionTemplate::route('/create'),
            'view' => Pages\ViewWorkoutSessionTemplate::route('/{record}'),
            'edit' => Pages\EditWorkoutSessionTemplate::route('/{record}/edit'),
        ];
    }
}
