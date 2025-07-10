<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'path',
        'type',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
