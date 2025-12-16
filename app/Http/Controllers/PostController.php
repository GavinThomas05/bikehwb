<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display a listing of posts
    public function index()
    {
        $posts = Post::with('user', 'comments.user')
            ->latest()
            ->get();

        return view('home', compact('posts'));
    }


    // Show the "create post" form
    public function create()
    {
        return view('posts.create');
    }

    // Store the post in the database
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        // Create the post linked to the logged-in user
        Post::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'body'    => $request->body,
        ]);

        return redirect('/')->with('success', 'Post created successfully');
    }
}

