<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\AreasTableSeeder;
use Database\Seeders\GenresTableSeeder;
use Database\Seeders\ShopsTableSeeder;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EvaluationTest extends TestCase
{
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function testEvaluation()
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

        $this->post('/api/evaluate', [
            'shop_id' => 1,
            'rating' => 5,
        ]);

        $this->assertDatabaseHas('evaluations', [
            'user_id' => 1,
            'shop_id' => 1,
            'rating' => 5,
        ]);
    }
}
