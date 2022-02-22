<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Support\Str;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs(
            User::factory()->create()
        );

        $this->payload = [
            'username' => 'faker',
            'password' => 'faker',
            'email' => 'faker@faker.com',
            'account' => 'faker'
        ];
    }


    public function test_if_an_account_was_created()
    {
        $response = $this->postJson(
            route('accounts.store'),
            $this->payload
        );

        $this->assertDatabaseHas('accounts', $this->payload);
        $response->assertCreated(201);
    }

    private function createAccount(int $count = 1)
    {
        $collection = Account::factory()
            ->count($count)
            ->for(User::factory()->create())
            ->create();

        if ($count == 1) {
            return $collection->first();
        }

        return $collection;
    }
}
