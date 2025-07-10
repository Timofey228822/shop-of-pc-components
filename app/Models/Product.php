<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'image_url'];
    
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category')->withPivot(['product_id', 'category_id']);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }
}
