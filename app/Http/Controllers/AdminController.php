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

    function indexAdmin(): View {
        $data = $this->adminService->getUsersAndProductsCount();

        return view('admin', compact('data'));
    }

    function storeProduct(AddProductRequest $request) {
        $this->adminService->add_product($request->validated());

        return redirect()->route('admin');
    }

    function indexDashboard() {

        $data = $this->adminService->getUsersAndProductsCount();

        return view('admin_dashboard', compact('data'));
    }

    function indexProducts() {

        $data = Product::paginate(15);

        return view('admin_products', compact('data'));
    }

    function indexCategories() {
        $data = $this->adminService->getAllCategories();

        return view('admin_categories', compact('data'));
    }

    function indexUsers() {
        $data = User::paginate(15)->where('role', 'user');

        return view('admin_users', compact('data'));
    }

    function indexAdmins() {
        $data = User::paginate(15)->where('role', 'admin');

        return view('admin_admin', compact('data'));
    }

    function createProduct() {
        $categories = Category::all();

        return view('admin_add_product', compact('categories'));
    }

    function editProduct($productId): View {
        
        $data = $this->adminService->change_product_page($productId);

        $categories = $data[1];
        $product = $data[0];

        return view('admin_change_product', compact('categories', 'product'));
    }

    function updateProduct($productId, AddProductRequest $request): RedirectResponse {
        $this->adminService->change_product($request->validated(), $productId);

        return redirect()->route('admin_products');
    }

    function deleteProduct($productId): RedirectResponse {
        Product::find($productId)->delete();

        return redirect()->route('admin_products');
    }

    function storeCategory(AddCategoryRequest $request): RedirectResponse {
        Category::create($request->validated());

        return redirect()->route('admin_categories');
    }

    function editCategory($CategoryId): View {
        $category = Category::find($CategoryId);

        return view('admin_update_category', compact('category'));
    }

    function updateCategory($CategoryId, AddCategoryRequest $request): RedirectResponse {
        Category::find($CategoryId)->update($request->validated());
        // мне лень писать сервис 8==Э

        return redirect()->route('admin_categories');
    }

    function deleteCategory($CategoryId): RedirectResponse {
        Category::find($CategoryId)->delete();

        return redirect()->route('admin_categories');
    }

    function deleteUser($userId) {
        User::find($userId)->delete();

        return redirect()->route('admin_users');
    }

    function promoteUserToAdmin(AddAdminRequest $request) {
        $this->adminService->update_users($request->validated(), 'admin');

        return redirect()->route('admin_admins');
    }

    function demoteAdminToUser($AdminId): RedirectResponse {
        User::find($AdminId)->update(['role' => 'user']);

        return redirect()->route('admin_admins');
    }
}
