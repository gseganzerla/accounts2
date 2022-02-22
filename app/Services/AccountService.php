<?php

namespace App\Services;


use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountService
{
    public function __construct(protected AccountRepositoryInterface $repository)
    {
    }

    public function store(array $data)
    {
        $this->repository->store($data);
    }
}
