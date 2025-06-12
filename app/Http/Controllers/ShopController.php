<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ShopController extends Controller
{

    function show_product_info($product_name) {
        $product = Product::where('name', $product_name)->first();

        return view('product', compact('product'));
    }
    function shop() {
        $data = DB::select('SELECT * FROM categories');

        // $lastId = DB::table('products')->latest('id')->first()?->id;
        // $result = [];

        // foreach(range(1, $lastId) as $num ) {
        //     $item = Product::find($num)->first();
        //     $result[$num - 1] = $item;
        // }

        $result = Product::all()->toArray();

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
