<?php

namespace Tests\Feature;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testUserIndex()
    {
        $exams = Exam::factory()->count(3)->create();

        User::factory()
            ->hasAttached($exams)
            ->create([
            'name' => 'First User',
        ]);

        User::factory()
            ->hasAttached($exams)
            ->create([
            'name' => 'Second User',
        ]);

        $user = User::factory()->create();
        $headers = ['Authorization' => "Bearer {$user->api_token}"];

        $this->json('GET', '/api/v1/users', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    ['name' => 'First User'],
                    ['name' => 'Second User'],
                ],
            ])
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'exams' => [
                            '*' => [
                                'id', 'name', 'start_at', 'grade',
                            ]
                        ]
                    ]
                ],
            ])
            ->assertJsonCount(3, 'data.*.exams');
    }
}
