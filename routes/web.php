<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

Route::get('/', [UserController::class, 'index'])->name('welcome');

Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/create', [UserController::class, 'create_user'])->name('create');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/auth', [UserController::class, 'auth_user'])->name('auth');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::put('/update_data', [UserController::class, 'update_data'])->name('update');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/shop/category_id={idForCategory}', [ShopController::class, 'show_product']);
Route::get('/product/productName={nameForProduct}', [ShopController::class, 'show_product_info'])->name('product');
Route::get('/dashboard/exit', [UserController::class, 'exit'])->name('exit');

Route::get('/admin', [AdminController::class, 'indexAdmin'])->name('admin');
Route::post('/admin/products/add_product', [AdminController::class, 'storeProduct'])->name('add_product');
Route::get('/admin/dashboard', [AdminController::class, 'indexDashboard'])->name('admin_dashboard');
Route::get('/admin/products', [AdminController::class, 'indexProducts'])->name('admin_products');
Route::get('/admin/categories', [AdminController::class, 'indexCategories'])->name('admin_categories');
Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin_users');
Route::get('/admin/admins', [AdminController::class, 'indexAdmins'])->name('admin_admins');
Route::get('/admin/products/add_product', function() {
    return view('admin_add_product');
})->name('add_product_page');
Route::get('/admin/changeProduct/productId={productId}', [AdminController::class, 'editProduct'])->name('change_product_page');
Route::put('/admin/changeProduct/productId={productId}/change', [AdminController::class, 'updateProduct'])->name('change_product');
Route::delete('/admin/products/delete/productId={productId}', [AdminController::class, 'deleteProduct'])->name('delete_product');
Route::get('/admin/categories/addCategory', function () {
    return view('admin_add_category');
})->name('add_category_page');
Route::post('/admin/categories/addCategory/adding', [AdminController::class, 'storeCategory'])->name('add_category');
Route::get('/admin/categories/updateCategory/CategoryId={CategoryId}', [AdminController::class, 'editCategory'])->name('update_category_page');
Route::post('/admin/categories/updateCategory/CategoryId={CategoryId}/update', [AdminController::class, 'updateCategory'])->name('update_category');
Route::delete('/admin/categories/deleteCategory/CategoryId={CategoryId}', [AdminController::class, 'deleteCategory'])->name('delete_category');
Route::delete('/admin/users/deleteUser/userId={userId}', [AdminController::class, 'deleteUser'])->name('delete_user');
Route::get('/admin/admin/addAdmin', function () {
    return view('admin_add_admin');
})->name('add_admin_page');
Route::put('/admin/admin/addAdmin/add', [AdminController::class, 'promoteUserToAdmin'])->name('add_admin');
Route::get('/admin/admin/changeAdmin/adminId={AdminId}', [AdminController::class, 'demoteAdminToUser'])->name('change_to_user');
Route::get('/product/productId={productId}', [CartController::class, 'updateCartItems'])->name('add_to_cart');
Route::get('/dashboard/productId={productId}', [CartController::class, 'deleteCartItem'])->name('delete_product_from_cart');