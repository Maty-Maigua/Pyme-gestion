<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cost = fake()->randomFloat(2, 100, 5000);
        return [
            'category_id' => Category::factory(), 
            'sku' => strtoupper(fake()->unique()->bothify('???-###')),
            'name' => ucfirst(fake()->unique()->words(3, true)),
            'price' => round($cost * 1.4, 2),
            'cost' => $cost,
            'stock' => fake()->numberBetween(0, 100),
            'min_stock' => 5,
            'active' => true,
        ];
    }
}
