<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'todo' => $this->faker->text(),
            'status' => 0,
        ];
    }

    /**
     * ステータスが完了した状態
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function done() {
        return $this->state(function (array $attributes) {
            return [
                'status' => 1,
            ];
        });
    }
}
