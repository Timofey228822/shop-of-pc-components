<?php
// app/Services/ExampleService.php

namespace App\Services;


use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductOrder;
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
        $glodal_income = User::sum('income');

        $latest_orders = ProductOrder::paginate(15);

        return [
            User::count(),
            Product::count(),
            ProductOrder::count(),
            $glodal_income,
            $latest_orders
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

        if ($data['image']) {
            $width = 550;
            $height = 250;

            $img = $data['image'];
            $path = $data['image']->store('products', 'public');
            $thumbnailPath = 'thumbs/' . pathinfo($path, PATHINFO_BASENAME);
            
            $imageInfo = getimagesize($data['image']->getRealPath());

            switch ($imageInfo['mime']) {
                case 'image/jpeg':
                    $sourceImage = imagecreatefromjpeg($img->getRealPath());
                    break;
                case 'image/png':
                    $sourceImage = imagecreatefrompng($img->getRealPath());
                    break;
                case 'image/webp':
                    $sourceImage = imagecreatefromwebp($img->getRealPath());
                    break;
                default:
                    throw new \Exception('Такие картинки создавать нельзя');
            }

            $originalWidth = imagesx($sourceImage);
            $originalHeight = imagesy($sourceImage);

            $ratio = min($width / $originalWidth, $height / $originalHeight);

            $newWidth = (int)($originalWidth * $ratio);
            $newHeight = (int)($originalHeight * $ratio);

            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresampled(
                $resizedImage, $sourceImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $originalWidth, $originalHeight
            );

            Storage::disk('public')->path($thumbnailPath);

            imagedestroy($sourceImage);
            imagedestroy($resizedImage);

            ProductImage::create([
                'product_id' => $product->id,
                'type' => 'thumbnail',
                'path' => $thumbnailPath,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'type' => 'main',
                'path' => $path,
            ]);
        }
        
        $product->categories()->attach([$data['category']]);

    }

    function getProductWithCategory(int $productId): Product
    {
        
        $product = Product::where('id', $productId)->with(['categories'])->firstOrFail();

        return $product;
    }

    function updateProduct(array $data, $productId): void {

        $product = Product::where('id', $productId)->first();

        if ($data['image']) {
            ProductImage::where('product_id', $product->id)->delete();

            $width = 550;
            $height = 230;

            $img = $data['image'];
            $path = $data['image']->store('products', 'public');
            $thumbnailPath = 'thumbs/' . pathinfo($path, PATHINFO_BASENAME);
            
            $imageInfo = getimagesize($data['image']->getRealPath());

            switch ($imageInfo['mime']) {
                case 'image/jpeg':
                    $sourceImage = imagecreatefromjpeg($img->getRealPath());
                    break;
                case 'image/png':
                    $sourceImage = imagecreatefrompng($img->getRealPath());
                    break;
                case 'image/webp':
                    $sourceImage = imagecreatefromwebp($img->getRealPath());
                    break;
                default:
                    throw new \Exception('Такие картинки создавать нельзя');
            }

            $originalWidth = imagesx($sourceImage);
            $originalHeight = imagesy($sourceImage);

            $ratio = min($width / $originalWidth, $height / $originalHeight);

            $newWidth = (int)($originalWidth * $ratio);
            $newHeight = (int)($originalHeight * $ratio);

            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

            imagecopyresampled(
                $resizedImage, $sourceImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $originalWidth, $originalHeight
            );

            imagedestroy($sourceImage);
            imagedestroy($resizedImage);

            ProductImage::create([
                'product_id' => $product->id,
                'type' => 'thumbnail',
                'path' => $thumbnailPath,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'type' => 'main',
                'path' => $path,
            ]);

            $fullPath = Storage::disk('public')->path($thumbnailPath);

            match($img->getMimeType()) {
                'image/jpeg' => imagejpeg($resizedImage, $fullPath, 85),
                'image/png' => imagepng($resizedImage, $fullPath, 6),
                'image/webp' => imagewebp($resizedImage, $fullPath, 6)
            };
        }

        $path = $data['image']->store('products', 'public');

        $product->update([$data]);

        $product->categories()->sync($data['category_id']);
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

