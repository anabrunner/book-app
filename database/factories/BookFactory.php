<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        // To simulate the file upload of the cover image.
        Storage::fake("public");

        return [
            'title' => fake()->name(),
            'author' => fake()->name(),
            'date_read' => fake()->date(),
            'shelf' => fake()->name(),
            'cover' => UploadedFile::fake()->image('cover.jpg'),
            'rating' =>fake()->numberBetween(1, 5),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
