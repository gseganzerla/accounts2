<?php

namespace App\Services;

use App\Jobs\UserCreatedJob;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{

    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function register(array $data)
    {
        $user = $this->userRepository->create($data);

        if (!Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        UserCreatedJob::dispatch($user);

        return $user;
    }

    public function login(array $data)
    {

        if (!Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = $this->userRepository->byEmail($data['email']);

        return $user;
    }

    public function logout(User $user)
    {
        Auth::logout();

        Auth::check();
        $a = 2;

    }
}
