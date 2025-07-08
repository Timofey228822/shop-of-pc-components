<?php

namespace App\Services;

use App\Models\Cart;

use Exception;
use Illuminate\Support\Facades\Session;

class CartService
{
    function addItemToCart($productId): void {
        if (!Session::get('gay')) {
            throw new Exception('вы гость');
        }

        $yourCart = Cart::where('user_id', Session::get('gay'))->firstOrFail();

        $yourCart->items()->create(['cart_id' => $yourCart->id, 'product_id' => $productId]);
    }

}