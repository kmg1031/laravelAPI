<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_created()
    {
        $userData = [
            'id' => 'testuser',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'name' => 'TestUser',
            'email' => 'test@example.com',
            'phone' => '1234567890',
        ];

        // log
        \Log::info($userData);

        $response = $this->post('/users', $userData);

        $this->assertDatabaseHas('users', [
            'id' => 'testuser',
        ]);

        $response->assertRedirect('/');

    }
}
