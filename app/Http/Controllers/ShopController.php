<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    function show_product_info($product_name)
    {
        $product = Product::where('name', $product_name)->first();

        return view('product', compact('product'));
    }
    function shop()
    {
        $products = Product::paginate(15);

        return view('shop', compact('products'));
    }

    function show_product($category_id)
    {
        $category = Category::find($category_id);

        $products = $category->products()->paginate(15);

        return view('shop', compact('products'));
    }
}
