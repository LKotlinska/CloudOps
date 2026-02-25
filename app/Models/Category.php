<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function categories()
    {
        return $this->hasMany(Product::class);
    }
}
