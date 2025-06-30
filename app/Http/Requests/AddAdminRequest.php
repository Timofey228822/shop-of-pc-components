<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends FormRequest
{
    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes['name'] = 'Имя';
        $attributes['email'] = 'Мыло';
        return $attributes;
    }

    public function rules()
    {
        return [
            'name' => 'string|required',
            'email' => 'email|required',
        ];
    }
}