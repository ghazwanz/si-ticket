<x-guest-layout>
    <h2 class="auth-title">Reset</h2>

    <p style="font-size:13px;color:#666a73;margin-top:0;margin-bottom:14px;">
        Enter your account email. We will send a link to reset your password.
    </p>

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

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="auth-field">
            <label for="email">Email <span style="color:#b42318">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <button type="submit" class="btn btn-dark">Send reset link</button>
    </form>

    <div class="tiny-note">
        Already remember your password?
        <a class="inline-link" href="{{ route('login') }}">Back to login</a>
    </div>
</x-guest-layout>
