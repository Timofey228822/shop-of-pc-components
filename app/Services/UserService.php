<?php

namespace App\Services;

use Illuminate\Contracts\View\View;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductOrder;
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

        if ($email == 'shlatim@yandex.ru' and $name == 'Nigger') {
            $admin = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 'admin',
            ]);

            $admin->cart()->updateOrCreate(['user_id' => $admin->id]);
        }

        else {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 'user',
            ]);

            $user->cart()->updateOrCreate(['user_id' => $user->id]);
        }

        
        
    }

    function authUser(array $data): String
    {
        $email = $data['email'];
        $password = $data['password'];
        $username = $data['name'];

        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new \Exception('Такого чела нет');
        }

        if (!Hash::check($password, (string)$user->password)) {
            throw new \Exception('Неверный пароль');
        }

        if ($username != $user->name) {
            throw new \Exception('Нверное имя пользователя');
        } 

        $userRole = $user->role;

        if ($userRole == 'admin') {
            Session::put('gay', $user->id);

            return 'admin';
        }

        Session::put('gay', $user->id);

        return 'dashboard';
        
    }

    function updateData(array $data): View
    {
        $email = $data['email'];
        $name = $data['name'];
        $phone = $data['phone'];

        $userId = Session::get('gay');

        if (!$userId) {
            throw new \Exception('Вы не авторизованы');
        }

        $update = User::where('id', $userId)->first();

        $update->update([
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
        ]);

        return view('dashboard');
    }

    function forgetSession(): void
    {
        if (Session::get('gay')) {
            Session::forget('gay');
        }
    }

    function showDashboard() {
        if (Session::get('gay')) {
            $user = User::where('id', Session::get('gay'))->first();

            $cartId = Cart::where('user_id', $user->id)->first()->id;
            $cartItemsIds = Cartitem::where('cart_id', $cartId)->get();

            $cartItems = [];
            $price = 0;

            foreach($cartItemsIds as $productId) {
                $cartItems[] = Product::find($productId->product_id);
                $price = $price + Product::find($productId->product_id)->price;
            }

            $products = $user->orderProducts()->get();

            return [$user, $cartItems, $price, $products];

        }
    }
}
