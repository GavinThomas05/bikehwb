<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
</head>
<body>

    <h1>{{ $user->name }}'s Profile</h1>

    @if($posts->isEmpty())
        <p>No posts yet.</p>
    @else
        @foreach($posts as $post)
            <div style="border:1px solid #ccc; margin:10px; padding:10px;">
                <!-- Edit/Delete buttons for user -->
                @auth
                    @if(auth()->id() === $post->user_id)
                        <a href="{{ route('posts.edit', $post) }}">
                            <button type="button">Edit</button>
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    @endif
                @endauth

                <h3>{{ $post->title }}</h3>
                <p>{{ $post->body }}</p>
                @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" style="max-width:200px;">
                @endif

                <h4>Comments:</h4>
                @foreach ($post->comments as $comment)
                    <div style="margin-left:20px; padding:5px; border-left:2px solid #aaa;">
                        <p>{{ $comment->body }}</p>
                        <p><em>By {{ $comment->user->name }}</em></p>
                        @auth
                        <!-- Comment delete button -->
                        @if (auth()->id() === $comment->user_id)
                        <form method="POST" action="{{ route('comments.destroyComment', $comment) }}" >
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        @endif
                        @endauth
                    </div>
                @endforeach
                <!-- Like count -->
                <p><strong>Likes:</strong> {{ $post->likes->count() }}</p>
            </div>
        @endforeach
    @endif

</body>
</html>


