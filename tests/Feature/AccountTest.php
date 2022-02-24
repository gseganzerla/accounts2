<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;

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

    public function test_if_return_a_list_of_owns_accounts()
    {
        $account = $this->createAccount(3);

        $response = $this->getJson(route('accounts.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'username',
                        'email',
                        'account',
                        'uuid'
                    ]
                ]
            ])->assertJson(
                fn (AssertableJson $json) =>
                $json->has('data', 3)
                    ->etc()
            );
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

    public function test_if_returned_an_account_by_uuid()
    {
        $account = $this->createAccount();

        $response = $this->getJson(route('accounts.show', $account->uuid));

        $response->assertJsonStructure([
            'data' => [
                'username',
                'email',
                'account',
                'uuid'
            ]
        ])->assertJson([
            'data' => [
                'uuid' => $account->uuid
            ]
        ]);
    }

    public function test_if_account_was_not_found()
    {
        $response = $this->getJson(route('accounts.show', 'fake-uuid'));

        $response->assertStatus(404);
    }

    public function test_if_account_was_updated()
    {
        $account = $this->createAccount();

        $response = $this->putJson(
            route('accounts.update', $account->uuid),
            $this->payload
        );

        $this->assertDatabaseHas('accounts', $this->payload);

        $this->assertDatabaseMissing('accounts', $account->toArray());
        $response->assertStatus(200);
    }

    public function test_if_account_was_deleted()
    {
        $account = $this->createAccount();

        $response = $this->deleteJson(route('accounts.destroy', $account->uuid));

        $this->assertDatabaseMissing('accounts', [
            'uuid' => $account->uuid
        ]);

        $response->assertStatus(204);
    }

    public function test_search_account() 
    {
        //Code
    }


    private function createAccount(int $count = 1)
    {
        $collection = Account::factory()->count($count)->create();

        if ($count == 1) {
            return $collection->first();
        }

        return $collection;
    }
}
