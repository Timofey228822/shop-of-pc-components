<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    function shop() {
        $data = DB::select('SELECT * FROM categories');

        $lastId = DB::table('products')->latest('id')->first()?->id;
        $result = [];

        foreach(range(1, 6) as $num ) {
            $item = Product::find($num)->first();
            $result[$num - 1] = $item;
        }

        return view('shop', compact('data', 'result'));
    }

    function show_product($category_id) {
        $data = DB::select('SELECT * FROM categories');
        $category = Category::find($category_id);
        $products = $category->products;
        $result = $products->map(function($product) {
            return [
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
            ];
        })->all();

        return view('shop', compact('result', 'data'));
    }

}
