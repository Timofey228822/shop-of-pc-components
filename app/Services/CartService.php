<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Models\CartItem;
use Exception;
use Illuminate\Support\Facades\Session;

class CartService
{
    function addItemToCart($productId): void
    {
        // проверяем гостя
        if (!Session::get('gay')) { /// TODO gay
            throw new Exception('вы гость');
        }

        //находим карзину
        $yourCart = Cart::where('user_id', Session::get('gay'))->firstOrCreate();

        //создаем ей вещи
        $yourCart->items()->create(
            [
                'cart_id' => $yourCart->id,
                'product_id' => $productId
            ]
        );
    }

    function makeOrder(): void
    {
        /// Получаем юзера
        $user = User::where('id', Session::get('gay'))->first(); /// gay TODO

        /// Получаем его корзину
        $user_cart = $user->cart()->first();

        /// Получаем все продукты
        $products = $user_cart->items()->get();

        /// Получаем сумму продуктов TODO rename
        $income = $user->orderProducts()->get()->sum('price');

        /// Добавляем продукты в заказ
        $ids = collect($products)->pluck('product_id')->toArray();

        $user->orderProducts()->attach($ids);

        $user->increment('income', $income);

        CartItem::where([
            'cart_id' => $user->cart()->first()->id,
        ])->delete();
    }
}
