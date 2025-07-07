<?php

use App\Models\Category;


return [
    'all_categories' => function() {
        return Category::all();
    }
];