<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\AreasTableSeeder;
use Database\Seeders\GenresTableSeeder;
use Database\Seeders\ShopsTableSeeder;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testOwnerCreate()
    {
        $this->seed(AreasTableSeeder::class);
        $this->seed(GenresTableSeeder::class);
        $this->seed(ShopsTableSeeder::class);

        $this->post('/api/owner-register', [
            'shop_id' => 1,
            'name' => 'unit_test_owner',
            'email' => 'unit_owner@test.com',
            'password' => 'password'
        ]);

        $this->assertDatabaseHas('owners', [
            'shop_id' => 1,
            'name' => 'unit_test_owner',
            'email' => 'unit_owner@test.com',
        ]);
    }
}
