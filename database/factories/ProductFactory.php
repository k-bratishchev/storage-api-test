<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(0, 1000),
            'price' => $this->faker->numberBetween(100, 10000),
            'properties' => $this->getRandomProperties(),
        ];
    }

    private function getRandomProperties() {
        return [
            'color' => $this->faker->randomElement(['red', 'green', 'blue', 'yellow', 'black', 'white']),
            'size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
        ];
    }
}
