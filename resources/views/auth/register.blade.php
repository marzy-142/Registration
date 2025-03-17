<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>
<body>
    <h2>Register</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <span>{{ $message }}</span> @enderror

        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <span>{{ $message }}</span> @enderror

        <label for="password">Password</label>
        <input type="password" name="password" required>
        @error('password') <span>{{ $message }}</span> @enderror

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Register</button>
    </form>

</body>
</html>
