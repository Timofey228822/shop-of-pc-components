<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    function index() {

        if (Session::get('gay')) {
            return redirect()->route('dashboard');
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
        $result = $this->dashboard();
        $data = $result['data'];

        return view($result['dashboard'], compact('data'));
    }
    function create_user(Request $request) {
        
        $validated = $request->validate([
        'name' => 'string',
        'email' => 'required|email|unique:user,email',
        'password' => 'string',
        ]);

        $result = $this->userService->create_user(
            $validated['name'],
            $validated['email'], 
            $validated['password']);
        
        return redirect()->route($result);
    }

    function auth_user(Request $request) {
        $validated = $request->validate([
        'email' => 'string',
        'username' => 'string',
        'password' => 'string',
        ]);

        $result = $this->userService->auth_user(
            $validated['email'], 
            $validated['username'],
            $validated['password']);
        
        return redirect()->route($result);
    }

    function update_data(Request $request) {
        $validated = $request->validate([
            'email' => 'string',
            'name' => 'string',
            'phone' => 'int',
            'password' => 'required|string'
        ]);
        
        $result = $this->userService->update_data(
            $validated['email'], 
            $validated['name'],
            $validated['phone'],
            $validated['password']);
        
        return redirect()->route($result);
    }

    function exit() {
        $result = $this->userService->exit();
        return view($result);
    }
}