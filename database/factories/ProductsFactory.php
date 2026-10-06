<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(0, 15000, 30000000),
            'category' => fake()->randomElement(['cat1', 'cat2', 'cat3']),
        ];
    }
}
