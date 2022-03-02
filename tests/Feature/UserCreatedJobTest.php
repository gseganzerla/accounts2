<?php

namespace Tests\Feature;

use App\Jobs\UserCreatedJob;
use App\Mail\WelcomeNewUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserCreatedJobTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_handle_job()
    {
        Mail::fake();

        $user = User::factory()->create();

        UserCreatedJob::dispatch($user);

        Mail::assertSent(function (WelcomeNewUser $mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
