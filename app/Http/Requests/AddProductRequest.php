<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes['name'] = 'Имя';
        $attributes['category'] = 'Кат';
        $attributes['price'] = 'Прайс';
        $attributes['description'] = 'Деск';
        return $attributes;
    }

    public function rules()
    {
        return [
            'name' => 'string|required',
            'category' => 'string|required', // Todo валидация категории + передаем id категории
            'price' => 'int|required',
            'description' => 'string|required',
        ];
    }
}