<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'image_url', 'category_id'];
    
    ////// TODO
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_orders');
    }
}
