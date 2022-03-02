<?php

namespace Tests\Feature;

use App\Jobs\UserCreatedJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private $route, $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->payload = [
            'name' => 'faker-name',
            'email' => 'faker.email@email.com',
            'password' => '123456'
        ];
    }
    /**
     * Test if user was registered.
     *
     * @return void
     */
    public function test_register()
    {
        $response = $this->postJson(route('auth.register'), $this->payload);

        $this->assertDatabaseHas('users', [
            'email' => $this->payload['email'],
            'name' => $this->payload['name']
        ]);

        $response->assertStatus(201);
    }

    public function test_register_with_job_queued() 
    {
        Queue::fake();

        $response = $this->postJson(route('auth.register'), $this->payload);

        $this->assertDatabaseHas('users', [
            'email' => $this->payload['email'],
            'name' => $this->payload['name']
        ]);

        
        $response->assertStatus(201);
        Queue::assertPushed(UserCreatedJob::class);
    }


    // change later
    // public function test_login()
    // {
    //     $user = User::factory()->create([
    //         'password' => '123456'
    //     ]);

    //     $payload = [
    //         'email' => $user->email,
    //         'password' => $user->password
    //     ];

    //     $response = $this->postJson(route('auth.login'), $payload);
    //     $this->assertAuthenticated();
    // }
}
