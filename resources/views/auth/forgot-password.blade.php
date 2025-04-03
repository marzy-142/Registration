<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div>
            <label for="email">Enter your email address:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <button type="submit">Send Password Reset Link</button>
    </form>

    @if(session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <a href="{{ route('login') }}">Back to Login</a>
</body>
</html>
