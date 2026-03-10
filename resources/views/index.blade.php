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
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>CloudOps</title>
</head>

<body>
    <main>
        <div class="login">
            <h1>Welcome</h1>
            <p>Sign in to your admin account</p>
            @include('errors')
            <form action="/login" method="POST">
                @csrf

                <label for="email">Email address</label>
                <input type="email"
                    id="email"
                    class="form-input"
                    name="email"
                    placeholder="admin@cloudops.se"
                    value="{{ old('email') }}">

                <label for="password">Password</label>
                <input type="password"
                    id="password"
                    class="form-input"
                    name="password"
                    placeholder="••••••"
                    value="{{ old('password') }}">

                <button type="submit" class="btn btn-primary">Sign in</button>

            </form>
            <div class="logo-mark">CloudOps</div>
        </div>
    </main>
</body>

</html>