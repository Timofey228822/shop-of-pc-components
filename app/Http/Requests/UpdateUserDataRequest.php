<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDataRequest extends FormRequest
{
    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes['name'] = 'Имя';
        $attributes['email'] = 'Мыло';
        $attributes['password'] = 'Пасс';
        $attributes['phone'] = 'Фон';
        return $attributes;
    }

    public function rules()
    {
        return [
            'email' => 'string',
            'name' => 'string',
            'phone' => 'int',
            'password' => 'required|string'
        ];
    }
}