<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'author' => fake()->name(),
            'date_read' => fake()->date(),
            'shelf' => fake()->name(),
            'cover' => fake()->image('cover.jpg'),
            'rating' =>fake()->numberBetween(1, 5)
        ];
    }
}
