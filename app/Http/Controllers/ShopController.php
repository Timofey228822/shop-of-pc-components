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

        //// TODO используй для таких запросов Eloquent ORM
        //// именуй переменные правильно не data а categories
        //// если ты испольуешь это запрос для меню сквозного, тееб нужно это переписать 
        //// чтобы не городить это запрос в каждом методе контроллера
        //// этот запрос должен быть глобальным, сделать такое можно через контейнер провайдер
        $data = DB::select('SELECT * FROM categories');

        //// TODO мусор не оставляем
        // $lastId = DB::table('products')->latest('id')->first()?->id;
        // $result = [];

        // foreach(range(1, $lastId) as $num ) {
        //     $item = Product::find($num)->first();
        //     $result[$num - 1] = $item;
        // }

        /// TODO используй пагинацию для товаров: all() делать нельзя
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
