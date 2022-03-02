<?php

namespace Tests\Feature;

use App\Mail\WelcomeNewUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeNewUserTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_assert_mailable_content()
    {
        $user = User::factory()->create();

        $mailable = new WelcomeNewUser($user);

        $mailable->assertSeeInHtml($user->name);
    }
}
