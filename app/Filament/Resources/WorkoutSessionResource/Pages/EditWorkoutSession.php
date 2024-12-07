<?php

namespace App\Filament\Resources\WorkoutSessionResource\Pages;

use App\Actions\WorkoutSession\CreateOrUpdateSingleExerciseWorkoutLog;
use App\Filament\Resources\WorkoutSessionResource;
use App\Models\Exercise;
use App\Models\WorkoutSession;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;

class EditWorkoutSession extends EditRecord
{
    protected static string $resource = WorkoutSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormModel(): WorkoutSession
    {
        return $this->record->load('exerciseLogs.exercise');
    }

    public function form(Form $form): Form
    {
        $exercises = Exercise::select('id', 'name')->get()->pluck('name', 'id');
        $workoutSession = $form->getRecord();

        $workoutSession->load('exerciseWorkoutSession.exerciseLogs.exercise');

        return $form
            ->schema(function () use ($exercises) {
                return [
                    Repeater::make('exerciseWorkoutSession')
                        ->schema(function () use ($exercises) {
                            return [
                                Select::make('exercise_id')
                                    ->label('Exercise')
                                    ->options($exercises)
                                    ->searchable()
                                    ->required()
                                    ->searchPrompt("Search exercise by it's name or category"),

                                Repeater::make('exerciseLogs')
                                    ->schema(function (Get $get) {
                                        return [
                                            TextInput::make('weight')
                                                ->label('Weight (kg)')
                                                ->required()
                                                ->numeric(),
                                            TextInput::make('reps')
                                                ->label('Reps')
                                                ->required()
                                                ->numeric(),
                                        ];
                                    })
                                    ->relationship()
                                    ->label('Set')
                                    ->columns(2)
                                    ->extraItemActions([
                                        Action::make('createOrUpdateSingleExerciseLog')
                                            ->icon('heroicon-m-check')
                                            ->action(function (array $arguments, Repeater $component): void {
                                                $keysToBeChecked = ['weight', 'reps'];

                                                $itemKey = $arguments['item'];
                                                $itemData = $component->getItemState($itemKey);
                                                $exerciseWorkoutSession = $component->getModelInstance();
                                                $currentState = $component->getState();

                                                $currentStateMappedValue = Arr::map($currentState, function (array $value) use ($keysToBeChecked) {
                                                    return Arr::only($value, $keysToBeChecked);
                                                });

                                                $key = array_search(Arr::only($itemData, $keysToBeChecked), $currentStateMappedValue);
                                                $index = array_search($key, array_keys($component->getState()));

                                                $exerciseLogId = Arr::get($component->getState($itemKey), "{$itemKey}.id");

                                                CreateOrUpdateSingleExerciseWorkoutLog::execute($component->getModelInstance(), [
                                                    ...$itemData,
                                                    'order_in_session' => $index + 1,
                                                    'exercise_id' => $exerciseWorkoutSession->exercise_id,
                                                    'id' => $exerciseLogId,
                                                ]);
                                            }),
                                    ])
                                    ->minItems(1),
                            ];
                        })
                        ->relationship()
                        ->orderColumn('order_in_session')
                        ->reorderable()
                        ->reorderableWithButtons()
                        ->afterStateUpdated(function ($state, $component) {
                            dd($state, $component);

                            $exerciseWorkoutSession = $component->getModelInstance();

                            $exerciseWorkoutSession->exerciseLogs->each(function ($exerciseLog, $index) {
                                $exerciseLog->order_in_session = $index + 1;
                                $exerciseLog->save();
                            });
                        }),
                ];
            });
    }
}
