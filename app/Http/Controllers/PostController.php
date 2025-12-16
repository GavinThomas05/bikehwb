<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //ftech all posts with their users and comments
    //pass the posts to the home view
    public function index()
    {
        //fetch all posts with their users and comments
        $posts = Post::with(['user', 'comments.user'])
            ->latest()// show newest first
            ->get();

        return view('home', compact('posts')); //pass posts to the home view
    }
}
