<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(700, 10000),
            'square_meters' => $this->faker->numberBetween(10, 20),
            'offices' => $offices = $this->faker->numberBetween(1, 50),
            'tables' => $this->faker->numberBetween(4, 1000),
        ];
    }
}
