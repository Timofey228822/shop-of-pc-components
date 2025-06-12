<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'материнские платы'],
            ['name' => 'оперативные памяти'],
            ['name' => 'блоки питания'],
            ['name' => 'процессоры'],
            ['name' => 'видеокарты'],
            ['name' => 'кулеры'],
            ['name' => 'прикольные кулеры'],
        ];
        
        foreach ($categories as $categoryData) {
            $category = new Category();
            $category->name = $categoryData['name'];
            $category->save();
        }

        // php artisan db:seed --class=CategoriesTableSeeder
    }
}
