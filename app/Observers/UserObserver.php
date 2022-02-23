<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user)
    {
        $user->password = bcrypt($user->password);
        $user->uuid = Str::uuid();
    }

    public function updating(User $user)
    {
        $user->password = bcrypt($user->password);
    }
}
