<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
    <h1>Here are all the categories</h1>

    <a href="./categories/create">New category</a>

    @foreach ($categories as $category)

        <a href="{{ route('categories.show', $category)}}">
            {{ $category->name }}
        </a>

        <a href="{{ route('categories.edit', $category) }}">Edit</a>

        <form action="{{ route('categories.destroy', $category)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

    @endforeach

</body>
</html>