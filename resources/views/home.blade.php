<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @auth
        {{-- showing the name of the user --}}
        <h1>Hello, {{ auth()->user()->name }}</h1>

        {{-- log out button --}}
        <form action="/logout" method="POST">
            @csrf
            <button>Log Out</button>
        </form>

        {{-- create post  --}}
        <div style="border: 3px solid black">
            <h1 style="text-align: center;">Create New Post</h1>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name="body" placeholder="body content..."></textarea>
                <button>Save Post</button>
            </form>
        </div>

        {{-- showing all posts --}}
        <div class="style="border: 3px solid black">
            <h2 style=" text-align: center; ">All Posts</h2>
            @foreach ($posts as $post)
                <div style="background-color: rgb(139, 202, 231); padding: 10px; margin: 10px">
                    <h3>{{ $post['title'] }} by <small>{{ $post->user->name }} </small> </h3>
                    {{ $post['body'] }}
                    <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div style="border: 3px solid black">
            <div>Register</div>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="name">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button>Register</button>
            </form>
            <div style="border: 3px solid black">
                <div>Log In</div>
                <form action="/login" method="POST">
                    @csrf
                    <input name="loginname" type="text" placeholder="name">
                    <input name="loginpassword" type="password" placeholder="password">
                    <button>Log In</button>
                </form>
            </div>
        @endauth

</body>

</html>
