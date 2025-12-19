<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;


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
            'image' => 'nullable|image|max:2048', // optional image upload
        ]);

        $data = [
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'body'    => $request->body,
        ];

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }else{
            $data['image_path'] = null;
        }

        // Create the post linked to the logged-in user
        Post::create($data);

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

    // Handle comment submission
    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'body' => $request->comment,
        ]);

        return redirect('/')->with('success', 'Comment added successfully');
    }
    // Handle comment deletion
    public function destroyComment(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }
        $comment->delete();
        return redirect('/')->with('success', 'Comment deleted successfully');
    }

    // Handle like/unlike functionality
    public function toggleLike(Post $post){
        $userId = Auth::id();

        $existingLike = Like::where('user_id', $userId)
            ->where('post_id', $post->id)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
        } else {
            // Like
            Like::create([
                'user_id' => $userId,
                'post_id' => $post->id,
            ]);
        }

        return back();
    }

}