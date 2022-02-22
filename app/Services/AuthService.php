<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService 
{

    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function register(array $data)
    {
        $user = $this->userRepository->create($data);

        return $user->createToken('login')->plainTextToken;
    }

    public function login(array $data)
    {
        $user = $this->userRepository->getByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return false;
        }

        return $user->createToken('login')->plainTextToken;
    }

    public function logout(User $user)
    {
        $user->tokens()->delete();
    }
}
