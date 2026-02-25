<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'nicotine_strength_mg',
        'volume_ml',
        'battery_capacity_mah',
    ];
}
