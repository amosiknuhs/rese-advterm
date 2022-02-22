<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class OwnerTest extends TestCase
{
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function testOwnerShopUpdate()
    {
        $this->seed(DatabaseSeeder::class);

        $this->post('/api/shop/edit', [
            'id' => 1,
            'name' => 'test',
            'content' => 'test',
            'area_id' => 1,
            'genre_id' => 1,
        ]);

        $this->assertDatabaseHas('shops', [
            'id' => 1,
            'name' => 'test',
            'content' => 'test',
            'area_id' => 1,
            'genre_id' => 1,
        ]);
    }
}
