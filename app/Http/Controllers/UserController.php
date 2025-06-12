<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index() {

        if (Session::get('gay')) {
            return Redirect('http://127.0.0.1:8000/dashboard');
        }

        return view('welcome');
    }

    function register() {

        

        return view('register');
    }

    function login() {
        return view('login');
    }

    function dashboard() {

        if (Session::get('gay')) {
            $data = User::where('id', Session::get('gay'))->first();
            return view('dashboard', compact('data'));
        }

        return view('dashboard');
    }
    function create_user(Request $request) {
        
        $validated = $request->validate([
        'name' => 'string',
        'email' => 'required|email|unique:user,email',
        'password' => 'string',
        ]);

        

        
        try {
        $reg = User::create($validated);
        } catch(Error) {
            return back()->with('error', 'Неверные данные');
        }
        
        return Redirect('http://127.0.0.1:8000/login');
    }

    function auth_user(Request $request) {
        $validated = $request->validate([
        'email' => 'string',
        'username' => 'string',
        'password' => 'string',
        ]);

        $user = User::where('email', $validated['email'])->first();
        
        if (!$user) {
            return back()->with('error', 'Неверные данные');
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return back()->with('error', 'Неверные данные');
        }

        else {
            if ($validated['username'] == $user->name) {
                Session::put('gay', $user->id);
                return Redirect('http://127.0.0.1:8000/dashboard');
            }
            else {
                
                return back()->with('error', 'Неверные данные');
            }
        }
    }

    function update_data(Request $request) {
        $validated = $request->validate([
        'email' => 'string',
        'name' => 'string',
        'phone' => 'string',
        'password' => 'required|string'
        ]);
        
        $update = User::where('email', $validated['email'])->first();

        if ($update) {
            if ($update->password != $validated['password']) {
                return back()->with('error', 'Неверный парол');
            }
        }

        else {
            return back()->with('error', 'Вы гость или бд сломалась');
        }

        

        $update->update($validated);

        return Redirect('http://127.0.0.1:8000/dashboard');
    }

    function exit() {
        if (Session::get('gay')) {
            Session::forget('gay');
            return view('welcome');
        }

        return view('welcome');
    }
}