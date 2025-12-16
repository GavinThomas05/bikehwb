<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Feed</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 2rem auto; }
        .post { border-bottom: 1px solid #ddd; padding: 1rem 0; }
        .comment { margin-left: 1rem; color: #555; }
        .meta { font-size: 0.9em; color: #777; }
    </style>
</head>
<body>

<h1>Post Feed</h1>

@foreach ($posts as $post)
    <div class="post">
        <h2>{{ $post->title }}</h2>

        <p class="meta">
            By {{ $post->user->name }}
            • {{ $post->created_at->diffForHumans() }}
        </p>

        <p>{{ $post->body }}</p>

        <h4>Comments ({{ $post->comments->count() }})</h4>

        @foreach ($post->comments as $comment)
            <div class="comment">
                <strong>{{ $comment->user->name }}:</strong>
                {{ $comment->body }}
            </div>
        @endforeach
    </div>
@endforeach

</body>
</html>
