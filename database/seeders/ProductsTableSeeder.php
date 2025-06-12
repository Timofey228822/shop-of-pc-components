<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Материнская плата ASUS ROG Strix',
                'description' => 'Для процессоров Intel, Socket 1200, чипсет Z490',
                'price' => 12999,
            ],
            [
                'name' => 'Оперативная память Kingston 16GB',
                'description' => 'DDR4, 3200MHz, 2x8GB',
                'price' => 5499,
            ],
            [
                'name' => 'Процессор Intel Core i7-10700K',
                'description' => '8 ядер, 16 потоков, 3.8 ГГц',
                'price' => 24999,
            ],
            [
                'name' => 'Видеокарта NVIDIA RTX 3070',
                'description' => '8GB GDDR6, 5888 ядер',
                'price' => 59999,
            ],
            [
                'name' => 'Блок питания Cooler Master 750W',
                'description' => '80+ Gold, модульный',
                'price' => 7299,
            ],
            [
                'name' => 'Кулер для процессора DeepCool',
                'description' => 'Тихий, RGB подсветка',
                'price' => 2999,
            ],
            
        ];

        // это по подсчетам 2023 года если что

        foreach($products as $product) {
            $seed = Product::create($product);
        }

        // php artisan db:seed --class=ProductsTableSeeder 
    }
}
