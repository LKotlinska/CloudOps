<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>
<body>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
    <h1>Here are all the products</h1>

    <a href="{{ route('products.create') }}">New product</a>

    @foreach ($products as $product)

        <a href="{{ route('products.show', $product)}}">
            {{ $product->name }}
        </a>

        <a href="{{ route('products.edit', $product) }}">Edit</a>

        <form action="{{ route('products.destroy', $product)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

    @endforeach
</body>
</html>