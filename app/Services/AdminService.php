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

    public function getAllCategories(): array
    {
        $allCategories = [];

        $categories = Category::all();

        foreach ($categories as $category) {
            array_push($allCategories, [$category->id, $category->name]);
        }

        return $allCategories;
    }

    function addProduct(array $data): void { 

        $product = Product::create($data);

        $product->categories()->attach([$data['category']]);

    }

    function getProductWithCategory(int $productId): Product
    {
        
        $product = Product::where('id', $productId)->with(['categories'])->firstOrFail();

        return $product;
    }

    function updateProduct(array $data, $productId): void {
        $name = $data['name'];
        $category_id = $data['category_id'];
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

    function updateUser(array $data, string $role): void {
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

