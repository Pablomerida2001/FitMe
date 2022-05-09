<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'calories' => $this->faker->numberBetween(50, 300),
            'carbohydrates' => $this->faker->numberBetween(0, 30),
            'fats' => $this->faker->numberBetween(0, 30),
            'protein' => $this->faker->numberBetween(0, 30),
        ];
    }
}
