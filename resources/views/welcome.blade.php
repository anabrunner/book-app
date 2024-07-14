<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Book app</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @if (Route::has('login'))
    <nav>
        @auth
        <a href="{{ url('/dashboard') }}">
            Dashboard
        </a>
        @else
        <a href="{{ route('login') }}">
            Log in
        </a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}">
            Register
        </a>
        @endif
        @endauth
    </nav>
    @endif
    </header>

    <main>


    </main>

    <x-footer />
</body>

</html>