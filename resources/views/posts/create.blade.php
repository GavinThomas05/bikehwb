<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>

    <h1>Create Post</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('posts.store') }}"
          enctype="multipart/form-data">
        
    @csrf

        <div>
            <label>Title</label><br>
            <input type="text" name="title">
        </div>

        <div>
            <label>Post Image</label><br>
            <input type="file" name="image" accept="image/*">
        </div>

        <div>
            <label>Content</label><br>
            <textarea name="body"></textarea>
        </div>

        <button type="submit">Create Post</button>
    </form>
</body>
</html> 

