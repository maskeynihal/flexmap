<?php

namespace App\Models;

use App\Observers\UserWeightObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([UserWeightObserver::class])]
class UserWeight extends Model
{
    use SoftDeletes;

    const WEIGHT_UNITS = [
        'kg' => [
            'label' => 'Kg',
            'value' => 'kg',
        ],
        'lbs' => [
            'label' => 'lbs',
            'value' => 'lbs',
        ],
    ];

    public $fillable = [
        'weight',
        'weight_unit',
        'measurement_date',
        'measurement_context',
        'comment',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
