<div class="flex justify-between m-3 w-full max-w-5xl">
    @if (Route::has('login'))
    <a href="{{ url('/') }}">Book App</a>
    <nav class="flex gap-3">
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