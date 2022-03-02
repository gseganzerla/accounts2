<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function __construct(
        private Account $entity
    ) {
    }

    public function all(?string $filter)
    {
        return $this->entity
            ->search($filter)
            ->get();
    }

    public function create(array $data)
    {
        $this->entity->create($data);
    }

    public function delete(int $id)
    {
    }

    public function byUuid(string $uuid)
    {

        return $this->entity->where('uuid', $uuid)->first();
    }

    public function update(Account $account, array $data)
    {
        $account->update($data);
    }

    public function destroyByUuid(string $uuid)
    {
        $this->entity->where('uuid', $uuid)->delete();
    }
}
