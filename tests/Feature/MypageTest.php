<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class MypageTest extends TestCase
{
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function testMypage()
    {
        $this->seed(DatabaseSeeder::class);

        $this->post('/api/user/login', [
            'email' => 'test@test.com',
            'password' => 'password'
        ]);

        $response = $this->json('get', '/api/mypage/reserves');
        $response->assertOK()
            ->assertJsonCount(10);

        $response = $this->json('get', '/api/mypage/favorites');
        $response->assertOK()
            ->assertJsonCount(4);
    }
}
