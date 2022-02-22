<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\AreasTableSeeder;
use Database\Seeders\GenresTableSeeder;
use Database\Seeders\ShopsTableSeeder;
use Tests\TestCase;
use App\Models\User;
use App\Models\Owner;
use App\Models\Admin;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    // use RefreshDatabase;
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function testUserLogin()
    {
        $this->user = User::factory()->create(
            [
                'name' => 'unit_test_user',
                'email' => 'unit_user@test.com',
                'password' => Hash::make('password')
            ]
        );
        $response = $this->json('post', '/api/user/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $response->assertOK();
    }

    public function testOwnerLogin()
    {
        $this->seed(AreasTableSeeder::class);
        $this->seed(GenresTableSeeder::class);
        $this->seed(ShopsTableSeeder::class);

        $this->owner = Owner::factory()->create(
            [
                'shop_id' => Shop::pluck('id')->random(),
                'name' => 'unit_test_owner',
                'email' => 'unit_owner@test.com',
                'password' => Hash::make('password')
            ]
        );
        $response = $this->json('post', '/api/owner/login', [
            'email' => $this->owner->email,
            'password' => 'password'
        ]);
        $response->assertOK();
    }

    public function testAdminLogin()
    {
        $this->admin = Admin::factory()->create(
            [
                'name' => 'unit_test_admin',
                'email' => 'unit_admin@test.com',
                'password' => Hash::make('password')
            ]
        );
        $response = $this->json('post', '/api/admin/login', [
            'email' => $this->admin->email,
            'password' => 'password'
        ]);
        $response->assertOK();
    }

    public function testLogout()
    {
        $response = $this->json(
            'post',
            '/api/logout'
        );
        $response->assertOK();
    }
}
