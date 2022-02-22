<?php

namespace App\Repositories\Contracts;

use App\Models\Account;

interface AccountRepositoryInterface
{
    public function all();
    public function update(Account $account, array $data);
    public function create(array $data);
    public function byUuid(string $uuid);
    public function destroyByUuid(string $uuid);
}