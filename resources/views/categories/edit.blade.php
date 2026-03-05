<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit category</title>
</head>
<body>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="name">Category name</label>
        <input
            type="text" 
            id="name" 
            name="name"
            placeholder="e.g. E-liquid"
            value="{{ $category->name }}"
            required
        />

        <button type="submit">Save changes</a>
    </form>

</body>
</html>