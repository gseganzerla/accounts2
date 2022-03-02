<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::factory()
            ->count(10)
            ->for(User::factory()
                ->state([
                    'email' => 'g.seganzerla@gmail.com'
                ])
                ->create());
    }
}