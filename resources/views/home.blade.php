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
    <a href="/">Home</a>
    <a href="/post">Post</a>
    <a href="/register">Register</a>
    <a href="/login">Login</a>
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
