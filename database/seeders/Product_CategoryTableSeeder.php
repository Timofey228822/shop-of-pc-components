<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class Product_CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data = [1, 2, 4 ,5, 3, 7];

        foreach(range(1, 6) as $i) {
            $product = Product::find($i);
            echo $product;
            $product->categories()->attach($data[$i - 1]);
        }

        // php artisan db:seed --class=Product_CategoryTableSeeder
    }
}
