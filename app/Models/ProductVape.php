<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVape extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVapeFactory> */
    use HasFactory;

    protected $fillable = [
        'has_podsystem',
        'puff_count',
        'product_id',
        'color_id',
    ];
}
