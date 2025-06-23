<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserDataRequest;
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

    function auth_user(CreateUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->userService->authUser($request->validated());

        return redirect()->route('dashboard');
    }

    function update_data(UpdateUserDataRequest $request)
    {
        $this->userService->updateData($request->validated());

        return redirect()->route('dashboard');
    }

    function exit()
    {
        $result = $this->userService->exit();
        return view($result);
    }
}
