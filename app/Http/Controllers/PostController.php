<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display a list of posts
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

    // Show edit form
    public function edit(Post $post)
    {
        // Check if current user is the creator
        if ($post->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        return view('posts.edit', compact('post'));
    }

    // Handle update
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect('/')->with('success', 'Post updated successfully');
    }

    // Handle delete
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect('/')->with('success', 'Post deleted successfully');
    }
}

