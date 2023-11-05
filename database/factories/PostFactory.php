<?php

namespace Database\Factories;

use App\Services\ImageService;
use App\Services\UnsplashService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $unsplashService = new UnsplashService();
        return [
            'title' => fake()->sentence(),
            'body' => fake()->text(),
            'user_id' => 1,
            'image' => $unsplashService->getRandomImage(),
        ];
    }
}
