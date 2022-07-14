<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function show(string $uuid): User
    {
        return $this->repository->byUuid($uuid);
    }

    public function update(User $user, array $data)
    {
        return $this->repository->update($user, $data);
    }

    public function destroy(User $user)
    {
        $this->repository->destroy($user);
    }

    public function me()
    {

        Auth::check();

        return $this->repository->byUuid(auth()->user()->uuid);
    }

    // trait to check the current password
    public function changeCurrentPassword(array $data)
    {
        $user = auth()->user();

        if (!$user || !Hash::check($data['old_password'], $user->password)) {
            return false;
        }

        $this->repository->updatePassword($user, $data['password']);
    }
}
