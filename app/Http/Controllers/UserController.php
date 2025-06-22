<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    function index()
    {
        if (Session::get('gay')) {
            return Redirect()->route('dashboard');
        }

        return view('welcome');
    }

    function register()
    {
        return view('register');
    }

    function login()
    {
        return view('login');
    }

    function dashboard()
    {

        if (Session::get('gay')) {
            $data = User::where('id', Session::get('gay'))->first();
            return view('dashboard', compact('data'));
        }

        return view('dashboard');
    }
    function create_user(CreateUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('login');
    }

    function auth_user(Request $request)
    {
        $validated = $request->validate([
            'email' => 'string',
            'username' => 'string',
            'password' => 'string',
        ]);

        $result = $this->userService->auth_user(
            $validated['email'],
            $validated['username'],
            $validated['password']
        );

        return redirect()->route($result);
    }

    function update_data(Request $request)
    {

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
            $validated['password']
        );

        return redirect()->route($result);
    }

    function exit()
    {
        $result = $this->userService->exit();
        return view($result);
    }
}
