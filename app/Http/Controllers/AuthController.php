<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Requests\StoreUpdateUser;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(protected AuthService $service)
    {
    }

    public function register(StoreUpdateUser $request)
    {
        $user = $this->service->register($request->all());

        return new UserResource($user, 201);
    }

    public function login(LoginUser $request)
    {
        $user = $this->service->login($request->all());

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        $this->service->logout(auth()->user());

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
