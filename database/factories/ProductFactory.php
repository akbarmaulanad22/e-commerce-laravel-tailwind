<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'user_id' => 1,
            'name' => $this->faker->words(5, true),
            'slug' => Str::slug($this->faker->words(5, true)),
            'category_id' => 1,
            'price' => $this->faker->randomNumber(5, true),
            'description' => $this->faker->paragraph(),
        ];
    }
}
