<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function __construct(protected Account $entity)
    {
    }

    public function store(array $data)
    {
        $this->entity->create($data);
    }
}
