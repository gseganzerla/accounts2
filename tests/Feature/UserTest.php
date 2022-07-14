<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);

        $this->payload = [
            'name' => 'faker',
            'email' => 'faker@faker.com',
        ];
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_user_by_uuid()
    {
        $response = $this->getJson(route('users.show', $this->user->uuid));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'name',
                    'email',
                    'identify'
                ]
            ])->assertJson([
                'user' => [
                    'identify' => $this->user->uuid
                ]
            ]);
    }

    public function test_if_user_was_updated()
    {
        $response = $this->putJson(
            route('users.update', $this->user->uuid),
            $this->payload
        );


        $this->assertDatabaseHas('users', [
            'name' => $this->payload['name'],
            'email' => $this->payload['email'],
        ]);
        $this->assertDatabaseMissing('users', $this->user->toArray());

        $response->assertStatus(200);
    }

    public function test_if_user_was_deleted()
    {
        $response = $this->deleteJson(route('users.destroy', $this->user->uuid));

        $this->assertDatabaseMissing('users', [
            'uuid' => $this->user->uuid
        ]);
        $response->assertStatus(200);
    }
}
