<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Models\CartItem;
use Illuminate\Support\Facades\Date;

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

    function makeOrder(): void {

        $user = User::where('id', Session::get('gay'))->first();

        $user_cart = $user->cart()->first();

        $products = $user_cart->items()->get();

        $income = $user->orderProducts()->get()->sum('price');

        $ids = collect($products)->pluck('product_id')->toArray();

        $user->orderProducts()->attach($ids);

        $user->increment('income', $income);

        CartItem::where([
            'cart_id' => $user->cart()->first()->id,
        ])->delete();
    }

}