<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Requests\StoreUser;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(StoreUser $request)
    {
        $token = $this->authService->register($request->all());

        return response()->json(['token' => $token], 201);
    }

    public function login(LoginUser $request) 
    {
        $token = $this->authService->login($request->all());

        if (!$token) {
            return response()->json(['message' => 'Credenciais invalidas'], 401);
        }

        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request) 
    {
        $this->authService->logout($request->user());
    }
}
