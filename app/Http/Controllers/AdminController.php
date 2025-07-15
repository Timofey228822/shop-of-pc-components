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

        $this->adminService->addProduct($request->validated());

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

        $categories = Category::all(); ///// TODO

        return view('admin_categories', compact('categories'));
    }

    function indexUsers() {

        $data = User::where('role', 'user')->paginate(15);

        return view('admin_users', compact('data'));
    }

    function indexAdmins() {
        $data = User::paginate(15)->where('role', 'admin');

        return view('admin_admin', compact('data'));
    }

    function editProduct($productId): View {
        
        $product = $this->adminService->getProductWithCategory($productId);

        return view('admin_change_product', compact('product'));
    }

    function updateProduct($productId, AddProductRequest $request): RedirectResponse {

        $this->adminService->updateProduct($request->validated(), $productId);

        return redirect()->route('admin_products');
    }

    function deleteProduct($productId): RedirectResponse {

        Product::findOrFail($productId)->delete();

        return redirect()->route('admin_products');
    }

    function storeCategory(AddCategoryRequest $request): RedirectResponse {
        Category::create($request->validated());

        return redirect()->route('admin_categories');
    }

    function editCategory($CategoryId): View {

        $category = Category::findOrFail($CategoryId);

        return view('admin_update_category', compact('category'));
    }

    function updateCategory($CategoryId, AddCategoryRequest $request): RedirectResponse {

        Category::findOrFail($CategoryId)->update($request->validated());

        return redirect()->route('admin_categories');
    }

    function deleteCategory($CategoryId): RedirectResponse {

        Category::findOrFail($CategoryId)->delete();

        return redirect()->route('admin_categories');
    }

    function deleteUser($userId) {

        User::findOrFail($userId)->delete();

        return redirect()->route('admin_users');
    }

    function promoteUserToAdmin(AddAdminRequest $request) {
        
        $this->adminService->updateUser($request->validated(), 'admin');

        return redirect()->route('admin_admins');
    }

    function demoteAdminToUser($AdminId): RedirectResponse {

        User::findOrFail($AdminId)->update(['role' => 'user']);

        return redirect()->route('admin_admins');
    }
}
