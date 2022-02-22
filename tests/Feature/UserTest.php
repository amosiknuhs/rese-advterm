<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function testUser()
    {
        $this->post('/api/register', [
            'name' => 'unit_test_user',
            'email' => 'unit_user@test.com',
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'unit_test_user',
            'email' => 'unit_user@test.com',
        ]);
    }
}
