<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use SoftDeletes;

    protected $casts = [
        'targets' => 'array',
    ];

    const EXERCISE_TYPES = [
        'strength' => [
            'label' => 'Strength',
            'value' => 'strength',
        ],
        'cardio' => [
            'label' => 'Cardio',
            'value' => 'cardio',
        ],
        'stretching' => [
            'label' => 'Stretching',
            'value' => 'stretching',
        ],
        'balance' => [
            'label' => 'Balance',
            'value' => 'balance',
        ],
        'mobility' => [
            'label' => 'Mobility',
            'value' => 'mobility',
        ],
    ];

    const EQUIPMENTS = [
        'machine' => [
            'label' => 'Machine',
            'value' => 'machine',
        ],
        'dumbbell' => [
            'label' => 'Dumbbell',
            'value' => 'dumbbell',
        ],
        'barbell' => [
            'label' => 'Barbell',
            'value' => 'barbell',
        ],
        'kettlebell' => [
            'label' => 'Kettlebell',
            'value' => 'kettlebell',
        ],
        'bodyweight' => [
            'label' => 'Bodyweight',
            'value' => 'bodyweight',
        ],
        'cable' => [
            'label' => 'Cable',
            'value' => 'cable',
        ],
        'band' => [
            'label' => 'Band',
            'value' => 'band',
        ],
    ];

    public $fillable = [
        'name',
        'description',
        'type',
        'equipment',
        'is_custom',
        'created_by',
        'main_target',
        'targets',
    ];
}
