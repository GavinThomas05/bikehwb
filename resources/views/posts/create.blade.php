<h1>Create Post</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('posts.store') }}">
    @csrf

    <div>
        <label>Title</label><br>
        <input type="text" name="title">
    </div>

    <div>
        <label>Body</label><br>
        <textarea name="body"></textarea>
    </div>

    <button type="submit">Create Post</button>
</form>
