<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAdminRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Services\AdminService;
use Illuminate\Contracts\View\View;
use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;


class AdminController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    function admin(): View {
        $data = $this->adminService->collectAllData('dashboard');

        return view('admin', compact('data'));
    }

    function add_product(AddProductRequest $request) {
        $this->adminService->add_product($request->validated());

        return redirect()->route('admin');
    }

    function dashboard() {
        $data = $this->adminService->collectAllData('dashboard');

        return view('admin_dashboard', compact('data'));
    }

    function products() {
        $data = $this->adminService->collectAllData('products');

        return view('admin_products', compact('data'));
    }

    function categories() {
        $data = $this->adminService->collectAllData('categories');

        return view('admin_categories', compact('data'));
    }

    function users() {
        $data = $this->adminService->collectAllData('users');

        return view('admin_users', compact('data'));
    }

    function admins() {
        $data = $this->adminService->collectAllData('admins');

        return view('admin_admin', compact('data'));
    }

    function add_product_page() {
        $categories = Category::all();

        return view('admin_add_product', compact('categories'));
    }

    function change_product_page($productId): View {
        $data = $this->adminService->change_product_page($productId);

        $categories = $data[1];
        $product = $data[0];

        return view('admin_change_product', compact('categories', 'product'));
    }

    function change_product($productId, AddProductRequest $request): RedirectResponse {
        $this->adminService->change_product($request->validated(), $productId);

        return redirect()->route('admin_products');
    }

    function delete_product($productId): RedirectResponse {
        Product::find($productId)->delete();

        return redirect()->route('admin_products');
    }

    function add_category(AddCategoryRequest $request): RedirectResponse {
        Category::create($request->validated());

        return redirect()->route('admin_categories');
    }

    function update_category_page($CategoryId): View {
        $category = Category::find($CategoryId);

        return view('admin_update_category', compact('category'));
    }

    function update_category($CategoryId, AddCategoryRequest $request): RedirectResponse {
        Category::find($CategoryId)->update($request->validated());
        // мне лень писать сервис 8==Э

        return redirect()->route('admin_categories');
    }

    function delete_category($CategoryId): RedirectResponse {
        Category::find($CategoryId)->delete();

        return redirect()->route('admin_categories');
    }

    function delete_user($userId) {
        User::find($userId)->delete();

        return redirect()->route('admin_users');
    }

    function add_admin(AddAdminRequest $request) {
        $this->adminService->update_users($request->validated(), 'admin');

        return redirect()->route('admin_admins');
    }

    function change_to_user($AdminId): RedirectResponse {
        User::find($AdminId)->update(['role' => 'user']);

        return redirect()->route('admin_admins');
    }
}
