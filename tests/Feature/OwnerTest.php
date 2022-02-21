<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class OwnerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

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
