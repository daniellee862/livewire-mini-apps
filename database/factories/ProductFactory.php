<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(),
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(2000),
            'price' => $this->faker->randomFloat(2, 5, 1000),
        ];
    }
}
