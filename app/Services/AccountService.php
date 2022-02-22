<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountService
{
    public function __construct(
        private AccountRepositoryInterface $repository
    ) {
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store(array $data)
    {
        $this->repository->create($data);
    }

    public function show(string $uuid): Account
    {
        return $this->repository->byUuid($uuid);
    }

    public function update(Account $account, array $data)
    {
        $this->repository->update($account, $data);
    }

    public function destroy(string $uuid)
    {
        $this->repository->destroyByUuid($uuid);
    }
}
