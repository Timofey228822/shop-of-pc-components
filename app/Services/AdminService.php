<?php
// app/Services/ExampleService.php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AdminService
{

    /**
     * Collects and returns the count of users and products.
     *
     * @return array<int, int> [users, products]
     */
    public function getUsersAndProductsCount(): array
    {
        return [
            User::count(),
            Product::count()
        ];
    }

    function collectAllData(string $type): array|LengthAwarePaginator|Collection {

        if ($type == 'dashboard') {
            $products = Product::count();
            $users = User::count();

            return [
                $users,
                $products
            ];
        }

        if ($type == 'products') {
            $first15Products = Product::paginate(15);

            return $first15Products;
        }

        if ($type == 'categories') {
            $allCategories = [];

            $categories = Category::all();

            foreach ($categories as $category) {
                array_push($allCategories, [$category->id, $category->name]);
            }

            return $allCategories;
        }

        if ($type == 'users') {
            $first15Users = User::paginate(15)->where('role', 'user');

            return $first15Users;
        }

        $allAdmins = User::paginate(15)->where('role', 'admin');

        return $allAdmins;

    }

    function add_product(array $data): void {
        $name = $data['name'];
        $category = Category::where('id',$data['category'])->first()->name;
        $price = $data['price'];
        $description = $data['description'];

        if (Product::where('name', $name)->first()) {
            throw new \Exception('Такой продукт уже есть');
        }

        Product::create([
            'name' => $name,
            'price' => $price,
            'description' => $description
        ]);

        $product = Product::where('name', $name)->first();
        $category_id = Category::where('name', $category)->first();

        $product->categories()->attach([$category_id]);

    }

    function change_product_page(int $productId): array {
        
        $product = Product::where('id', $productId)->first();

        $categories = Category::all();

        $categories_massive = [[$product->categories->pluck('id')->toArray()[0], $product->categories->pluck('name')->toArray()[0]]];

        foreach ($categories as $category) {
            if (!in_array([$category->id, $category->name], $categories_massive)) {
                array_push($categories_massive, [$category->id, $category->name]);
            }
        }

        return [$product, $categories_massive];
    }

    function change_product(array $data, $productId): void {
        $name = $data['name'];
        $category_id = $data['category'];
        $price = $data['price'];
        $description = $data['description'];

        $update = Product::where('id', $productId)->first();

        $update->update([
            'name' => $name,
            'price' => $price,
            'description' => $description,
        ]);

        $update->categories()->sync($category_id);
    }

    function update_users(array $data, string $role): void {
        $email = $data['email'];
        $username = $data['name'];

        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new \Exception('такого чела нет');
        }

        $user->update([
            'role' => $role,
        ]);
    }

}

