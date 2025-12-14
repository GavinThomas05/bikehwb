<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Assign a random existing user or create one if none exist
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            // Assign a random existing post or create one if none exist
            'post_id' => Post::inRandomOrder()->first()?->id ?? Post::factory(),
            'body' => $this->faker->paragraph(),//creates a random fake body text
        ];
    }
}
