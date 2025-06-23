<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    function add_to_cart($name) {
        $this->cartService->add_item($name);
    }
}
