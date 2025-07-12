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

    public function __construct(
        protected ImageService $imageService
    ) {}

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

    function addProduct(array $data): void
    {

        //// Транзакционность
        try {
            DB::beginTransaction();

            $product = Product::create($data);


            if ($data['image']) {
                $this->imageService->createThumbnailAndImage($data['image'], $product);
            }

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
        return Product::where('id', $productId)->with(['category'])->firstOrFail();
    }

    function updateProduct(array $data, $productId): void
    {

        $product = Product::where('id', $productId)->firstOrFail();


        try {
            DB::beginTransaction();

            if ($data['image']) {
                $this->imageService->updateBothImages($data['image'], $product);
            }

            $path = $data['image']->store('products', 'public');

            $product->update([$data]);

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
            throw new \Exception('Нельзя обновить изображение');
        }


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
        // role это роль, которая передается чтобы присвоить админу или пользователю
        $email = $data['email'];

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
