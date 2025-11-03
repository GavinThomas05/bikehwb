<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTableSeeder::class, //creates users first
            PostTableSeeder::class, //then creates posts each with an assigned user
            CommentTableSeeder::class,//Comments are created and assigns a user and a post
        ]);
    }
}
