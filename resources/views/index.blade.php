<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@400;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>CloudOps</title>
</head>

<body>
    <main>
        <div class="login">
            <h1>Login Page</h1>
            @include('errors')
            <form action="/login" method="POST">
                @csrf

                <label for="email">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}">

                <button type="submit" class="btn btn-primary">Login</button>

            </form>
        </div>
    </main>
</body>

</html>