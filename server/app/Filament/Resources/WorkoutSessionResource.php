<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkoutSessionResource\Pages;
use App\Models\Exercise;
use App\Models\WorkoutSession;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WorkoutSessionResource extends Resource
{
    protected static ?string $model = WorkoutSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $exercises = Exercise::select('id', 'name')->get()->pluck('name', 'id');

        return $form
            ->columns(1)
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Select Template')
                        ->columnSpanFull()
                        ->description('Select a template to load default exercises')
                        ->schema(function () {
                            $templates = \App\Models\WorkoutSessionTemplate::select(['name', 'description', 'id'])->get();
                            $options = $templates->mapWithKeys(fn ($template) => [$template->id => $template->name])->toArray();
                            $descriptions = $templates->mapWithKeys(fn ($template) => [$template->id => $template->description])->toArray();

                            return [
                                Radio::make('workout_session_template_id')
                                    ->label('Template')
                                    ->options($options)
                                    ->descriptions($descriptions)
                                    ->live()
                                    ->required()
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state, ?string $old) {
                                        if ($state === $old) {
                                            return;
                                        }

                                        $template = \App\Models\WorkoutSessionTemplate::with('exerciseWorkoutSessionTemplate')->find($get('workout_session_template_id'));

                                        $default_exercises = $template->exerciseWorkoutSessionTemplate
                                            ->sortBy('order_in_session')
                                            ->map(fn ($exercise) => ['exercise_id' => $exercise->exercise_id])
                                            ->toArray();

                                        $set('exercises', $default_exercises);
                                        $set('name', $template->name);
                                    }),
                            ];
                        }),
                    Wizard\Step::make('Update Session Exercises')
                        ->description('Add or remove the exercise that you will do in this session')
                        ->schema(function () use ($exercises) {
                            return [
                                Repeater::make('exercises')
                                    ->simple(
                                        Select::make('exercise_id')
                                            ->label('Exercise')
                                            ->options($exercises)
                                            ->searchable()
                                            ->required()
                                            ->searchPrompt("Search exercise by it's name or category")
                                    )->afterStateUpdated(function (Set $set, $state) {
                                        // TODO: Check why new array item is created on reorder
                                        $set('exercises', array_filter($state, fn ($exercise) => is_array($exercise)));
                                    }),
                                TextInput::make('name')
                                    ->label('Session Name')
                                    ->helperText('Give a name to this session')
                                    ->required(),
                            ];
                        }),
                ])
                    ->submitAction(
                        Action::make('create')
                            ->label('Start Session')
                            ->submit('create')
                            ->keyBindings(['mod+s'])
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListWorkoutSessions::route('/'),
            'create' => Pages\CreateWorkoutSession::route('/create'),
            'edit' => Pages\EditWorkoutSession::route('/{record}/edit'),
        ];
    }
}
