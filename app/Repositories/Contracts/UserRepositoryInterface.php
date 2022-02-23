<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function update(User $user, array $data);
    public function destroy(User $user);
    public function byUuid(string $uuid): User;
    public function byEmail(string $email): User;
    public function updatePassword(user $user, string $password);
}
