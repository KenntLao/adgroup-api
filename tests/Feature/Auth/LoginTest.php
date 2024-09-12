<?php

namespace Tests\Feature\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
    }

    public function test_login_with_unregistered_email()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'nonexistentemail@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
            'message' => 'Email is not registered.',
            'code' => Response::HTTP_UNAUTHORIZED
            ]);
    }

    public function test_login_with_incorrect_password()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'johndoe@example.com',
            'password' => 'wrong_password'
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
            'message' => 'Invalid Credentials.',
            'code' => Response::HTTP_UNAUTHORIZED
            ]);
    }

    public function test_successful_login()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'johndoe@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'token',
                'user' => [
                    'id',
                    'name',
                    'email'
                ]
            ]);
    }
}
