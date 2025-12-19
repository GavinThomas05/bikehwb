<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\user;
use Illuminate\Support\Arr;

class PostFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            'app/public/images/image1.jpg',
            'app/public/images/image2.jpg',
            'app/public/images/image3.jpg',
            'app/public/images/image4.jpg',
            'app/public/images/image5.jpg',
            null,
        ];

        return [
            // Assign a random existing user, or create one if none exist
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'image_path' => Arr::random($images), // optional field
            'category' => $this->faker->randomElement(['trip', 'gear', 'modification', 'motorcycle', 'event']),
        ];
    }
}
