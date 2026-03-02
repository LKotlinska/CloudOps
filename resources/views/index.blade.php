<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>Login Page</h1>
        @include('errors')
        <form action="/login" method="POST">
            @csrf

            <label for="email">Email address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="{{ old('password') }}">

            <button type="submit">Login</button>

        </form>
    </main>
</body>
</html>