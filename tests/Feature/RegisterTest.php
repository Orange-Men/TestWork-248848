<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testRequires()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The name field is required. (and 2 more errors)',
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ]);
    }

    public function testsRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'test1234',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The password confirmation does not match.',
                'errors' => [
                    'password' => ['The password confirmation does not match.'],
                ],
            ]);
    }

    public function testRegister()
    {
        $payload = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'api_token',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
}
