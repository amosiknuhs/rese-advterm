<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\AreasTableSeeder;
use Database\Seeders\GenresTableSeeder;
use Database\Seeders\ShopsTableSeeder;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function testShop()
    {
        $this->seed(AreasTableSeeder::class);
        $this->seed(GenresTableSeeder::class);
        $this->seed(ShopsTableSeeder::class);

        $response = $this->json('get', '/api/');
        $response->assertOK();
    }
}
