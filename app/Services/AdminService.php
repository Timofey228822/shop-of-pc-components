<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class AdminService
{

    /**
     * Collects and returns the count of users and products.
     *
     * @return array<int, int> [users, products]
     * 
     *  ///// TODO
     */
    public function getUsersAndProductsCount(): array
    {
        $glodal_income = User::sum('income');

        $latest_orders = ProductOrder::paginate(15);

        return [
            'users' => User::count(),
            'products' => Product::count(),
            'orders' => ProductOrder::count(),
            'glodal_income' => $glodal_income,
            'latest_orders' => $latest_orders
        ];
    }

    ///// TODO
    public function getAllCategories(): array
    {
        $allCategories = [];

        $categories = Category::all();

        foreach ($categories as $category) {
            array_push($allCategories, [$category->id, $category->name]);
        }

        return $allCategories;
    }


    function addProduct(array $data): void
    {

        //// Транзакционность
        try {
            DB::beginTransaction();

            $product = Product::create($data);

            //// вынести  в отдельный сервис где будет все с картинками
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
                    $resizedImage,
                    $sourceImage,
                    0,
                    0,
                    0,
                    0,
                    $newWidth,
                    $newHeight,
                    $originalWidth,
                    $originalHeight
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

            DB::commit();
        } catch (Throwable $th) {
            DB::rollback();
            Log::error(
                'Не удалось создать товар',
                [
                    'Exception' => $th->getMessage(),
                    'data'      => $data,
                ]
            );
            throw new \Exception('Такие картинки создавать нельзя');
        }
    }

    function getProductWithCategory(int $productId): Product
    {
        return Product::where('id', $productId)->with(['categories'])->firstOrFail();
    }

    function updateProduct(array $data, $productId): void
    {

        $product = Product::where('id', $productId)->firstOrFail();

        //// TODO
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
                $resizedImage,
                $sourceImage,
                0,
                0,
                0,
                0,
                $newWidth,
                $newHeight,
                $originalWidth,
                $originalHeight
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

            match ($img->getMimeType()) {
                'image/jpeg' => imagejpeg($resizedImage, $fullPath, 85),
                'image/png' => imagepng($resizedImage, $fullPath, 6),
                'image/webp' => imagewebp($resizedImage, $fullPath, 6)
            };
        }

        $path = $data['image']->store('products', 'public');

        $product->update([$data]);

        $product->categories()->sync($data['category_id']);
    }

    /**
     * Updates a user's role
     * TODO
     * @param array $data Email and name of the user
     * @param string $role New role of the user
     *
     * @throws \Exception If the user does not exist
     */
    public function updateUser(array $data, string $role): void
    {
        // Get the email and name from the data
        $email = $data['email'];
        //$username = $data['name'];

        // Find the user by email
        $user = User::where('email', $email)->first();

        // If the user does not exist, throw an exception
        if (!$user) {
            throw new \Exception('Такого чела нет');
        }

        // Update the user's role
        $user->update([
            'role' => $role,
        ]);
    }
}
