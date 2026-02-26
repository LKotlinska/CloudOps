<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'nicotine_strength_mg',
        'volume_ml',
        'category_id',
        'brand_id',
        'flavor_id',
        'color_id',
    ];
}
