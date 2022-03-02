<?php

namespace App\Services;

use App\Jobs\UserCreatedJob;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function register(array $data)
    {
        $user = $this->userRepository->create($data);

        UserCreatedJob::dispatch($user);

        return $user->createToken('login')->plainTextToken;
    }

    public function login(array $data)
    {
        $user = $this->userRepository->byEmail($data['email']);

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
