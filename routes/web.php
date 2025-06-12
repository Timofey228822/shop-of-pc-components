<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;

Route::get('/',[UserController::class, 'index']);

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/create', [UserController::class, 'create_user'])->name('create');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/auth', [UserController::class, 'auth_user'])->name('auth');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dasboard');
Route::put('/update_data', [UserController::class, 'update_data'])->name('update');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/shop/category_id={x}', [ShopController::class, 'show_product']);
