<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
{
    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes['name'] = 'Имя';
        return $attributes;
    }

    public function rules()
    {
        return [
            'name' => 'string|required|max:15',
        ];
    }
}