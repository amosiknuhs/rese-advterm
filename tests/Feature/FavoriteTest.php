<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\AreasTableSeeder;
use Database\Seeders\GenresTableSeeder;
use Database\Seeders\ShopsTableSeeder;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testFavorite()
    {
        $this->seed(AreasTableSeeder::class);
        $this->seed(GenresTableSeeder::class);
        $this->seed(ShopsTableSeeder::class);

        $this->user = User::factory()->create(
            [
                'name' => 'unit_test_user',
                'email' => 'unit_user@test.com',
                'password' => Hash::make('password')
            ]
        );
        $this->post('/api/user/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $this->post('/api/favorite', [
            'isFavorite' => 0,
            'shopId' => 1,
        ]);

        $this->assertDatabaseHas('favorites', [
            'user_id' => 1,
            'shop_id' => 1,
        ]);

        $this->post('/api/favorite', [
            'isFavorite' => 1,
            'shopId' => 1,
        ]);

        $this->assertDatabaseMissing('favorites', [
            'user_id' => 1,
            'shop_id' => 1,
        ]);
    }
}
