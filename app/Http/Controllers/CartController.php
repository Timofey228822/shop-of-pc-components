<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\CartItem;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    function updateCartItems($productId) {
        $this->cartService->addItemToCart($productId);

        return redirect()->route('shop');
    }

    function deleteCartItem($productId) {

        $product = CartItem::where('product_id', $productId)->first()->delete();

        return redirect()->route('dashboard');
    }

    function makeOrder() {

        $this->cartService->makeOrder();

        return redirect()->route('dashboard');
    }
}
