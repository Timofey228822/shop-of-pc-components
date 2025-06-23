<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

Route::get('/',[UserController::class, 'index']);

Route::get('/register', function() {
    return view('register');
})->name('register');
Route::post('/create', [UserController::class, 'create_user'])->name('create');
Route::get('/login', function() {
    return view('login');
})->name('login');
Route::post('/auth', [UserController::class, 'auth_user'])->name('auth');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::put('/update_data', [UserController::class, 'update_data'])->name('update');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/shop/category_id={x}', [ShopController::class, 'show_product']);
Route::get('/product/productName={x}', [ShopController::class, 'show_product_info']);
Route::get('/dashboard/exit', [UserController::class, 'exit'])->name('exit');
Route::get('/product/productName={x}/add_to_cart', [CartController::class, 'add_to_cart'])->name('add_to_cart');

