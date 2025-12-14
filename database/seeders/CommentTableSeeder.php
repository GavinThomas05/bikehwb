<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;


class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        
        foreach ($posts as $post) {
            // For each post, create a random number of comments between 1 and 5
            Comment::factory(rand(1, 5))->create([
                'post_id' => $post->id,
            ]);
        }
        //creates 100 comments
        Comment::factory(100)->create();
    }
}
