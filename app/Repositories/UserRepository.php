<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $entity;

    public function __construct(User $entity)
    {
        $this->entity = $entity;
    }

    public function create(array $data): User
    {
        return $this->entity->create($data);
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    public function byEmail(string $email): User
    {
        return $this->entity->where('email', $email)->first();
    }

    public function byUuid(string $uuid): User
    {
        return $this->entity->where('uuid', $uuid)->first();
    }

    public function updatePassword(User $user, string $password)
    {
        $user->password = bcrypt($password);
    }
}
