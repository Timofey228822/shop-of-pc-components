<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserDataRequest;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    function index(): View
    {
        if (Session::get('gay')) {
            return Redirect()->route('dashboard');
        }

        return view('welcome');
    }

    function dashboard(): View
    {

        if (Session::get('gay')) {
            $data = User::where('id', Session::get('gay'))->first();
            return view('dashboard', compact('data'));
        }

        return view('dashboard');
    }
    function create_user(CreateUserRequest $request): RedirectResponse
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('login');
    }

    function auth_user(CreateUserRequest $request): RedirectResponse
    {
        $userRole = $this->userService->authUser($request->validated());

        return redirect()->route($userRole);
    }

    function update_data(UpdateUserDataRequest $request): RedirectResponse
    {
        $this->userService->updateData($request->validated());

        return redirect()->route('dashboard');
    }

    function exit(): RedirectResponse
    {
        $this->userService->forgetSession();

        return redirect()->route('welcome');
    }
}
