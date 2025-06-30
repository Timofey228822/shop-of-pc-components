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
        return $attributes;
    }

    public function rules()
    {
        return [
            'email' => 'string|required',
            'name' => 'string|required',
            'phone' => [
                'required',
                'string',
                'max:20',
                function ($attribute, $value, $fail) {
                    $digits = preg_replace('/[^0-9+]/', '', $value);
                    if (strlen($digits) < 5) {
                        $fail('Номер телефона слишком короткий.');
                    }
                }
            ]
        ];
    }
}