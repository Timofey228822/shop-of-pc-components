<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class ShopController extends Controller
{

    function show_product_info($product_name) {

        $product = Product::where('name', $product_name)->first();

        return view('product', compact('product'));
    }
    function shop() {

        $categories = Category::all();

        $products = Product::paginate(15);

        return view('shop', compact('categories', 'products'));
    }

    function show_product($category_id) {

        $categories = Category::all();

        $category = Category::find($category_id);
        
        $products = $category->products()->paginate(15);

        return view('shop', compact('products', 'categories'));
    }

}
