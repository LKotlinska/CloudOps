<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Color;


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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
