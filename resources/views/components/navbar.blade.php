<div class="flex justify-between p-3 w-full max-w-5xl">
    @if (Route::has('login'))
    <a href="{{ url('/') }}" class="flex gap-2 justify-center items-center">
        <img src="/book-app-logo.png" alt="Dragon Reading a Book" width="50">
        The Moonlight Archives
    </a>
    <nav class="flex gap-3 justify-center items-center">
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
</div>