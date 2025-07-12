<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes['name'] = 'Имя';
        $attributes['category_id'] = 'Кат';
        $attributes['price'] = 'Прайс';
        $attributes['description'] = 'Деск';
        $attributes['image'] = 'имаг';
        return $attributes;
    }

    public function rules()
    {
        return [
            'name'          => 'string|required',
            'category_id'   => 'required|exists:categories,id',
            'price'         => 'int|required',
            'description'   => 'string|required',
            'image'         => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ];
    }
}