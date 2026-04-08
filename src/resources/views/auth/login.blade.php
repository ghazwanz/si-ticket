<x-guest-layout>
    <h2 class="auth-title">Login</h2>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="auth-field">
            <label for="email">Email <span style="color:#b42318">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        </div>

        <div class="auth-field">
            <label for="password">Password <span style="color:#b42318">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
        </div>

        <div class="auth-action-row">
            <label>
                <input id="remember_me" type="checkbox" name="remember">
                Remember me
            </label>
        </div>

        <button type="submit" class="btn btn-dark">Login</button>
    </form>

    <button type="button" class="btn btn-light" aria-label="Login with Google">G Login with Google</button>
    <button type="button" class="btn btn-light" aria-label="Login with Microsoft">M Login with Microsoft</button>
    <button type="button" class="btn btn-light" aria-label="Login with SSO">Login with SSO</button>

    <div class="tiny-note">
        Forgot password?
        @if (Route::has('password.request'))
            <a class="inline-link" href="{{ route('password.request') }}">Reset it</a>
        @endif
    </div>

    @if (Route::has('register'))
        <div class="tiny-note">
            Don't have an account?
            <a class="inline-link" href="{{ route('register') }}">Register first</a>
        </div>
    @endif
</x-guest-layout>
