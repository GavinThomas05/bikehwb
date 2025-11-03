<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\user;

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
        return [
            // Assign a random existing user, or create one if none exist
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'image_path' => null, // optional field
            'category' => $this->faker->randomElement(['trip', 'gear', 'modification', 'motorcycle', 'event']),
        ];
    }
}
