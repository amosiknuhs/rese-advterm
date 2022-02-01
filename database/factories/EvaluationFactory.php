<?php

namespace Database\Factories;

use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evaluation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(2, 2),
            'shop_id' => $this->faker->numberBetween(1, 20),
            'rating' => $this->faker->randomFloat(1, 2, 4.5),
            'comment' => 'ユーザーの口コミを表示する。ユーザーの口コミを表示する。ユーザーの口コミを表示する。ユーザーの口コミを表示する。ユーザーの口コミを表示する。ユーザーの口コミを表示する。ユーザーの口コミを表示する。ユーザーの口コミを表示する。ユーザーの口コミを表示する。ユーザーの口コミを表示する。',
        ];
    }
}
