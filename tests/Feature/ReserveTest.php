<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\AreasTableSeeder;
use Database\Seeders\GenresTableSeeder;
use Database\Seeders\ShopsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Tests\TestCase;

class ReserveTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testReserve()
    {
        $this->seed(AreasTableSeeder::class);
        $this->seed(GenresTableSeeder::class);
        $this->seed(ShopsTableSeeder::class);
        $this->seed(UsersTableSeeder::class);

        $this->post('/api/user/login', [
            'email' => 'test@test.com',
            'password' => 'password'
        ]);

        $this->post('/api/reserve', [
            'user_id' => 1,
            'shop_id' => 1,
            'date' => '2022-01-01',
            'time' => '11:00:00',
            'number' => 1,
        ]);

        $this->assertDatabaseHas('reserves', [
            'user_id' => 1,
            'shop_id' => 1,
            'date' => '2022-01-01',
            'time' => '11:00:00',
            'number' => 1,
        ]);

        $this->post('/api/change', [
            'id' => 1,
            'user_id' => 1,
            'shop_id' => 1,
            'date' => '2022-02-02',
            'time' => '12:00:00',
            'number' => 5,
        ]);

        $this->assertDatabaseHas('reserves', [
            'user_id' => 1,
            'shop_id' => 1,
            'date' => '2022-02-02',
            'time' => '12:00:00',
            'number' => 5,
        ]);

        $this->post('/api/cancel', [
            'reserveId' => 1,
        ]);

        $this->assertDatabaseMissing('reserves', [
            'user_id' => 1,
            'shop_id' => 1,
            'date' => '2022-02-02',
            'time' => '12:00:00',
            'number' => 5,
        ]);
    }
}
