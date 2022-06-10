<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Requests\StoreUser;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(protected AuthService $service)
    {
    }

    public function register(StoreUser $request)
    {
        $token = $this->service->register($request->all());

        return response()->json(['token' => $token], 201);
    }

    public function login(LoginUser $request)
    {
        $user = $this->service->login($request->all());

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        $this->service->logout($request->user());
    }
}
