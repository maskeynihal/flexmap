<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserWeightResource\Pages;
use App\Models\UserWeight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserWeightResource extends Resource
{
    protected static ?string $model = UserWeight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('weight')
                    ->numeric()
                    ->inputMode('decimal')
                    ->minValue(0)
                    ->required(),

                Forms\Components\Select::make('weight_unit')
                    ->options(collect(UserWeight::WEIGHT_UNITS)->mapWithKeys(fn (array $item) => [$item['value'] => $item['label']]))
                    ->default(UserWeight::WEIGHT_UNITS['kg']['value'])
                    ->required(),

                Forms\Components\DateTimePicker::make('measurement_date')
                    ->seconds(false)
                    ->native(false)
                    ->maxDate(now())
                    ->required(),

                Forms\Components\Select::make('measurement_context')
                    ->options([
                        'empty_stomach' => 'Empty Stomach',
                        'after_breakfast' => 'After Breakfast',
                        'before_lunch' => 'Before Lunch',
                        'after_lunch' => 'After Lunch',
                        'before_dinner' => 'Before Dinner',
                        'after_dinner' => 'After Dinner',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('comment'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('weight')
                    ->formatStateUsing(fn (UserWeight $record) => $record->weight.' '.UserWeight::WEIGHT_UNITS[$record->weight_unit]['label'])

                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('measurement_date')
                    ->dateTime()
                    ->dateTimeTooltip()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('measurement_context')
                    ->formatStateUsing(fn (UserWeight $record) => ucfirst(str_replace('_', ' ', $record->measurement_context)))
                    ->searchable()
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
            'index' => Pages\ListUserWeights::route('/'),
            'create' => Pages\CreateUserWeight::route('/create'),
            'view' => Pages\ViewUserWeight::route('/{record}'),
            'edit' => Pages\EditUserWeight::route('/{record}/edit'),
        ];
    }
}
