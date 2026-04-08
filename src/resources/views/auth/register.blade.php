<x-guest-layout>
    <h2 class="auth-title">Register</h2>

    @if ($errors->any())
        <div class="auth-errors">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="auth-field">
            <label for="name">Name <span style="color:#b42318">*</span></label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
        </div>

        <div class="auth-field">
            <label for="email">Email <span style="color:#b42318">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
        </div>

        <div class="auth-field">
            <label for="password">Password <span style="color:#b42318">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
        </div>

        <div class="auth-field">
            <label for="password_confirmation">Confirm Password <span style="color:#b42318">*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-dark">Create account</button>
    </form>

    <div class="tiny-note">
        Already registered?
        <a class="inline-link" href="{{ route('login') }}">Login</a>
    </div>
</x-guest-layout>
