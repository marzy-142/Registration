<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Login</title>
</head>
<body>
    <h1>Login to Your Account</h1>

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Login</button>
    </form>

    <a href="{{ route('password.request') }}">Forgot Password?</a>
    <a href="{{ route('register') }}">Don't have an account? Register here</a>
</body>
</html>
