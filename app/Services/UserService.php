<?php

namespace App\Services;

use App\Models\User;
use PhpOption\None;
use Throwable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserService
{
    function createUser(array $data): void
    {
        $name = $data['name'];
        $email = $data['email'];
        $password = Hash::make($data['password']);  

        if (User::where('email', $email)->first()) {
            throw new \Exception('Такой чел уже есть');
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    function auth_user(string $email, string $username, string $password)
    {

        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new \Exception('Такого чела нет');
        }

        if (!Hash::check($password, $user->password)) {
            throw new \Exception('Неверный пароль');
        }


        if ($username == $user->name) {
            Session::put('gay', $user->id);
            return 'dashboard';
        } 

        throw new \Exception('Нверное имя пользователя');
    }

    function update_data(string $email, string $name, int $phone = Null, string $password)
    {
        $update = User::where('email', $email)->first();

        if ($update) {
            if (!Hash::check($password, $update->password)) {

                throw new \Exception('Неверный пароль');
            }
        } else {

            throw new \Exception('Вы гост');
        }

        $update->update([
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'password' => $password
        ]);

        return 'dashboard';
    }

    function exit()
    {
        if (Session::get('gay')) {
            Session::forget('gay');
        }

        return 'welcome';
    }

    function dashboard()
    {
        //eст СЛИШКОМ много памяти
        $data = null;

        if (Session::get('gay')) {
            $data = User::where('id', Session::get('gay'))->first();
        }

        $response = [
            'view' => 'dashboard',
            'data' => $data
        ];

        return $response;
    }
}
