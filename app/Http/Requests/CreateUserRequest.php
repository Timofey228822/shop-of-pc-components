<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes['name'] = 'Имя';
        $attributes['email'] = 'Мыло';
        $attributes['password'] = 'Пасс';
        return $attributes;
    }

    public function rules()
    {
        return [
            'name' => 'string',
            'email' => 'required|email|unique:user,email',
            'password' => 'string',
        ];
    }
}
