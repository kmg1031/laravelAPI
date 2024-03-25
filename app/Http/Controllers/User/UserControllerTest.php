<?php

namespace Tests\Unit\Controllers\User;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('user.store'), $userData);

        $response->assertRedirect(route('register'));
        $response->assertSessionHas('success', 'User successfully registered.');

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);
    }

    /**
     * Test user registration with invalid data.
     *
     * @return void
     */
    public function testUserRegistrationWithInvalidData()
    {
        $userData = [
            'name' => '',
            'email' => 'invalidemail',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('user.store'), $userData);

        $response->assertSessionHasErrors(['name', 'email']);
        $this->assertDatabaseMissing('users', [
            'email' => 'invalidemail',
        ]);
    }
}
