<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
<!--Nav bar-->
<nav>
    <!-- Actions for authenticated users when signed in-->
    @auth
        <!-- show button to create new post -->
        <a href="{{ route('posts.create') }}">
            <button type="button">New Post</button>
        </a>
        <!-- Show logout button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth
    <!-- Show login/register links if not authenticated (Viewing as a guest) -->
    @guest
        <a href="/login">
            <button type="button">Login</button>
        </a>
        <a href="/register">
            <button type="button">Register</button>
        </a>
    @endguest
</nav>

<!--Page heading-->
<h1>Home Page</h1>
<h2>Post Feed:</h2>

    @foreach ($posts as $post)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->body }}</p>
            <p><strong>Author:</strong> {{ $post->user->name }}</p>

            <h4>Comments:</h4>
            @foreach ($post->comments as $comment)
                <div style="margin-left:20px; padding:5px; border-left:2px solid #aaa;">
                    <p>{{ $comment->body }}</p>
                    <p><em>By {{ $comment->user->name }}</em></p>
                </div>
            @endforeach
        </div>
    @endforeach

</body>
</html>
